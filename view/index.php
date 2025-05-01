<?php
use Src\Model\Employee;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/src/component/css/app.css">
    <link rel="stylesheet" href="/src/component/css/table.css">
</head>
<body class="full-center">
    <div class="container">
        <h2 class="full-center">Swirflabs Technical Test</h2>
        <br>
        <?php
            if (isset($_SESSION['alert'])) {
                echo $_SESSION['alert']->render();
            }
        ?>
        <form action="/employee/store" id="employeeForm" style="margin-bottom: 1rem;" method="POST">
            <div class="form-group">
                <label for="identificationNumber">Identification Number</label>
                <input type="text" id="identificationNumber" name="identificationNumber" class="form-control" placeholder="Enter Identification Number" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Insert Employee Name" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" id="age" name="age" class="form-control" placeholder="Insert Age" required>
            </div>
            <div class="form-group">
                <label for="occupation">Occupation</label>
                <select name="occupation" id="occupation" class="form-control" required>
                    <option value="" disabled selected>Select Employee Occupation</option>
                    <?php foreach (Employee::OCCUPATIONS as $occupation): ?>
                        <option value="<?= $occupation ?>"><?= $occupation ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" placeholder="Insert Address" required>
            </div>
            <div class="form-group">
                <label for="place">Place</label>
                <input type="text" id="place" name="place" class="form-control" placeholder="Insert Place" required>
            </div>
            <div class="form-group">
                <label for="dateOfBirth">Date of Birth</label>
                <input type="date" id="dateOfBirth" name="dateOfBirth" class="form-control" placeholder="Insert Date of Birth" required>
            </div>
        </form>
        <div class="form-group" style="display: flex; justify-content: space-between; flex-direction: row;">
            <button type="submit" class="btn btn-primary" style="width: 100%" form="employeeForm">Submit</button>
            <button type="reset" class="btn btn-secondary" style="width: 100%" form="employeeForm">Reset</button>
        </div>

        <div style="max-width: 100%; overflow-x: auto;">
            <table class="table" style="min-width: 70rem;">
                <thead class="thead">
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Occupation</th>
                    </tr>
                </thead>
                <tbody class="tbody" id="employeeTable">
                    <?php foreach ($employees as $employee): ?>
                        <tr class="tr">
                            <td><?= htmlspecialchars($employee->getIdentificationNumber()) ?></td>
                            <td style="width: 30%; text-align: right;"><?= htmlspecialchars($employee->getName()) ?></td>
                            <td style="width: 10%; text-align: center; font-size: <?php echo 12 * 1.2; ?>pt">
                                <?php
                                    $dateOfBirth = $employee->getDateOfBirth();
                                    $currentDate = new DateTime();
                                    $birthDate = new DateTime($dateOfBirth);
                                    $age = $currentDate->diff($birthDate)->y;
                                    echo htmlspecialchars($age) . " years old";
                                ?>
                            <td style="width: 40%;"><?= htmlspecialchars($employee->getAddress()) ?></td>
                            <td style="width: 20%; text-align: right;"><?= htmlspecialchars($employee->getOccupation()) ?></td>
                            <td><?= htmlspecialchars($employee->getPlace()) ?></td>
                            <td><?= htmlspecialchars($employee->getDateOfBirth()) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function calculateAge(dateOfBirth) {
            const birthDate = new Date(dateOfBirth); // Convert the date of birth to a Date object
            const today = new Date(); // Get the current date

            let age = today.getFullYear() - birthDate.getFullYear(); // Calculate the difference in years

            // Adjust the age if the birthday hasn't occurred yet this year
            const monthDifference = today.getMonth() - birthDate.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            return age;
        }
        async function fetchEmployees() {
            try {
                const res = await fetch('/api/employee', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (!res.ok) {
                    throw new Error(`HTTP error! Status: ${res.status}`);
                }

                const data = await res.json(); // Parse the JSON response
                const returnable = () => {
                    return data.map(employee => {
                        return `
                            <tr class="tr">
                                <td style="width: 30%; text-align: right;">${employee.name}</td>
                                <td style="width: 10%; text-align: center; font-size: 12pt">${calculateAge(employee.dateOfBirth)} years old</td>
                                <td style="width: 40%;">${employee.address}</td>
                                <td style="width: 20%; text-align: right;">${employee.occupation}</td>
                            </tr>`;
                    }).join('');
                }
            } catch (error) {
                console.error('Error fetching employees:', error);
            }
        }

        // Call the function to fetch employees
        fetchEmployees();
    </script>
</body>
</html>