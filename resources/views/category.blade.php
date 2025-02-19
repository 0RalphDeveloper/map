<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laborer Category & Utensils</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        label {
            font-size: 18px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .utensils-container {
            margin-top: 20px;
        }

        .utensils-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            list-style: none;
        }

        .utensils-list li {
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
        }

        @media (max-width: 400px) {
            select {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <label for="laborer-category">Select a Laborer:</label>
        <select id="laborer-category" onchange="updateUtensils()">
            <option value="">-- Choose Category --</option>
            <option value="farmers">Farmers</option>
            <option value="plumbers">Plumbers</option>
            <option value="electricians">Electricians</option>
            <option value="carpenters">Carpenters</option>
        </select>

        <div class="utensils-container">
            <h3>Required Utensils:</h3>
            <ul id="utensils-list" class="utensils-list"></ul>
        </div>
    </div>

    <script>
        const utensilsData = {
            farmers: ["Hoe", "Shovel", "Rake", "Watering Can", "Sickle"],
            plumbers: ["Pipe Wrench", "Plunger", "Teflon Tape", "Hacksaw", "Basin Wrench"],
            electricians: ["Multimeter", "Wire Cutter", "Voltage Tester", "Screwdrivers", "Insulated Gloves"],
            carpenters: ["Hammer", "Chisel", "Measuring Tape", "Saw", "Drill"]
        };

        function updateUtensils() {
            const category = document.getElementById("laborer-category").value;
            const utensilsList = document.getElementById("utensils-list");
            utensilsList.innerHTML = "";

            if (category && utensilsData[category]) {
                utensilsData[category].forEach(utensil => {
                    const li = document.createElement("li");
                    li.textContent = utensil;
                    utensilsList.appendChild(li);
                });
            }
        }
    </script>

</body>
</html>
