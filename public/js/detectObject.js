document
    .getElementById("processImageBtn")
    .addEventListener("click", function () {
        const imageInput = document.getElementById("imageInput");
        if (!imageInput.files[0]) {
            alert("Please select an image.");
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            const base64Image = event.target.result.split(",")[1]; // Remove the base64 prefix

            // Send the base64 image to Roboflow
            axios({
                method: "POST",
                url: "https://detect.roboflow.com/pbkk-ktp2z/1",
                params: {
                    api_key: "BlWuPckGMJfSImJQh71n",
                },
                data: base64Image,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
            })
                .then(function (response) {
                    console.log(response.data);

                    // Get the first prediction class (you can handle multiple predictions if needed)
                    const predictions = response.data.predictions;
                    if (predictions.length > 0) {
                        let detectedClass = predictions[0].class; // Example: "rok"

                        // Convert "rok" to "skirt"
                        if (detectedClass.toLowerCase() === "rok") {
                            detectedClass = "skirt";
                        } else if (detectedClass.toLowerCase() === "t-shirt") {
                            detectedClass = "shirt";
                        }

                        updateCategorySelect(detectedClass);
                    } else {
                        alert("No objects detected.");
                    }
                })
                .catch(function (error) {
                    console.error("Error processing image:", error);
                });
        };

        reader.readAsDataURL(imageInput.files[0]);
    });

function updateCategorySelect(detectedClass) {
    const categorySelect = document.getElementById("categorySelect");

    // Check if the category already exists
    let optionExists = false;
    for (let i = 0; i < categorySelect.options.length; i++) {
        if (
            categorySelect.options[i].value.toLowerCase() ===
            detectedClass.toLowerCase()
        ) {
            optionExists = true;
            categorySelect.selectedIndex = i; // Automatically select it
            break;
        }
    }

    // If it doesn't exist, add a new <option> and select it
    if (!optionExists) {
        const newOption = document.createElement("option");
        newOption.value = detectedClass.toLowerCase();
        newOption.text =
            detectedClass.charAt(0).toUpperCase() + detectedClass.slice(1); // Capitalize
        newOption.className = "text-black";

        categorySelect.appendChild(newOption);
        categorySelect.selectedIndex = categorySelect.options.length - 1; // Select the new option
    }

    // Submit the form to filter based on the detected class
    categorySelect.form.submit();
}