<?php
define('PASSWORD', 'correctpassword');

$employees = [
    ['firstName' => 'John', 'lastName' => 'Doe', 'title' => 'Developer', 'age' => 30, 'dateHired' => '2015-06-01', 'dateFired' => '', 'successes' => 10, 'hasComputer' => true, 'activity' => 100],
    ['firstName' => 'Jane', 'lastName' => 'Smith', 'title' => 'Designer', 'age' => 25, 'dateHired' => '2018-09-15', 'dateFired' => '', 'successes' => 5, 'hasComputer' => true, 'activity' => 80],
    ['firstName' => 'Michael', 'lastName' => 'Johnson', 'title' => 'Manager', 'age' => 35, 'dateHired' => '2010-01-10', 'dateFired' => '', 'successes' => 15, 'hasComputer' => true, 'activity' => 120],
    ['firstName' => 'Alex', 'lastName' => 'Johnson', 'title' => 'Developer', 'age' => 28, 'dateHired' => '2017-03-12', 'dateFired' => '', 'successes' => 8, 'hasComputer' => true, 'activity' => 90],
    ['firstName' => 'Emily', 'lastName' => 'Brown', 'title' => 'Designer', 'age' => 27, 'dateHired' => '2019-11-05', 'dateFired' => '', 'successes' => 6, 'hasComputer' => true, 'activity' => 85],
    ['firstName' => 'Daniel', 'lastName' => 'Wilson', 'title' => 'Manager', 'age' => 40, 'dateHired' => '2008-07-20', 'dateFired' => '', 'successes' => 20, 'hasComputer' => true, 'activity' => 130],
    ['firstName' => 'Olivia', 'lastName' => 'Taylor', 'title' => 'Developer', 'age' => 32, 'dateHired' => '2014-09-30', 'dateFired' => '', 'successes' => 12, 'hasComputer' => true, 'activity' => 95],
    ['firstName' => 'William', 'lastName' => 'Anderson', 'title' => 'Designer', 'age' => 29, 'dateHired' => '2016-02-18', 'dateFired' => '', 'successes' => 7, 'hasComputer' => true, 'activity' => 88],
    ['firstName' => 'Sophia', 'lastName' => 'Martinez', 'title' => 'Manager', 'age' => 38, 'dateHired' => '2011-05-25', 'dateFired' => '', 'successes' => 18, 'hasComputer' => true, 'activity' => 125],
    ['firstName' => 'James', 'lastName' => 'Thomas', 'title' => 'Developer', 'age' => 31, 'dateHired' => '2013-11-10', 'dateFired' => '', 'successes' => 11, 'hasComputer' => true, 'activity' => 92],
    ['firstName' => 'Ava', 'lastName' => 'Hernandez', 'title' => 'Designer', 'age' => 26, 'dateHired' => '2020-07-08', 'dateFired' => '', 'successes' => 4, 'hasComputer' => true, 'activity' => 75],
    ['firstName' => 'Benjamin', 'lastName' => 'Garcia', 'title' => 'Manager', 'age' => 37, 'dateHired' => '2012-03-15', 'dateFired' => '', 'successes' => 17, 'hasComputer' => true, 'activity' => 115],
    ['firstName' => 'Mia', 'lastName' => 'Lopez', 'title' => 'Developer', 'age' => 33, 'dateHired' => '2016-12-05', 'dateFired' => '', 'successes' => 9, 'hasComputer' => true, 'activity' => 87]
];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password']) && $_POST['password'] === PASSWORD) {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $newEmployee = [
                    'firstName' => $_POST['firstName'],
                    'lastName' => $_POST['lastName'],
                    'title' => $_POST['title'],
                    'age' => $_POST['age'],
                    'dateHired' => $_POST['dateHired'],
                    'dateFired' => $_POST['dateFired'],
                    'successes' => $_POST['successes'],
                    'hasComputer' => isset($_POST['hasComputer']),
                    'activity' => $_POST['activity']
                ];
                $employees[] = $newEmployee;
                break;

            case 'delete':
                $index = $_POST['index'];
                if (isset($employees[$index])) {
                    array_splice($employees, $index, 1);
                }
                break;

            case 'edit':
                $index = $_POST['index'];
                if (isset($employees[$index])) {
                    $employees[$index] = [
                        'firstName' => $_POST['firstName'],
                        'lastName' => $_POST['lastName'],
                        'title' => $_POST['title'],
                        'age' => $_POST['age'],
                        'dateHired' => $_POST['dateHired'],
                        'dateFired' => $_POST['dateFired'],
                        'successes' => $_POST['successes'],
                        'hasComputer' => isset($_POST['hasComputer']),
                        'activity' => $_POST['activity']
                    ];
                }
                break;

            case 'sort':
                if ($_POST['sortType'] === 'name') {
                    usort($employees, function ($a, $b) {
                        return strcmp($a['firstName'], $b['firstName']);
                    });
                } elseif ($_POST['sortType'] === 'dateHired') {
                    usort($employees, function ($a, $b) {
                        return strcmp($a['dateHired'], $b['dateHired']);
                    });
                }
                break;

            case 'search':
                $searchResults = [];
                $searchValue = $_POST['searchValue'];
                foreach ($employees as $employee) {
                    if (
                        strpos(strtolower($employee['firstName']), strtolower($searchValue)) !== false ||
                        strpos(strtolower($employee['lastName']), strtolower($searchValue)) !== false ||
                        strpos(strtolower($employee['dateHired']), strtolower($searchValue)) !== false
                    ) {
                        $searchResults[] = $employee;
                    }
                }
                $employees = $searchResults;
                break;
        }
    }
    echo renderEmployeeManagementSystem($employees);
} else {
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="">
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
<?php
}

function renderEmployeeManagementSystem($employees)
{
    ob_start();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="employee-container">
        <h2>Employee Management</h2>
        <form method="POST" action="" class="action">
            <input type="hidden" name="password" value="<?php echo PASSWORD; ?>">
            <input type="hidden" name="action" value="add">
            <input type="text" name="firstName" placeholder="First Name" required>
            <input type="text" name="lastName" placeholder="Last Name" required>
            <input type="text" name="title" placeholder="Title" required>
            <input type="number" name="age" placeholder="Age" required>
            <input type="date" name="dateHired" placeholder="Date Hired" required>
            <input type="date" name="dateFired" placeholder="Date Fired">
            <input type="number" name="successes" placeholder="Successes" required>
            <label><input type="checkbox" name="hasComputer"> Has Computer</label>
            <input type="number" name="activity" placeholder="Activity" required>
            <button type="submit">Add Employee</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Title</th>
                    <th>Age</th>
                    <th>Date Hired</th>
                    <th>Date Fired</th>
                    <th>Successes</th>
                    <th>Has Computer</th>
                    <th>Activity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $index => $employee): ?>
                <tr>
                    <td><?php echo htmlspecialchars($employee['firstName']); ?></td>
                    <td><?php echo htmlspecialchars($employee['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($employee['title']); ?></td>
                    <td><?php echo htmlspecialchars($employee['age']); ?></td>
                    <td><?php echo htmlspecialchars($employee['dateHired']); ?></td>
                    <td><?php echo htmlspecialchars($employee['dateFired']); ?></td>
                    <td><?php echo htmlspecialchars($employee['successes']); ?></td>
                    <td><?php echo $employee['hasComputer'] ? 'Yes' : 'No'; ?></td>
                    <td><?php echo htmlspecialchars($employee['activity']); ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="password" value="<?php echo PASSWORD; ?>">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <button type="submit">Delete</button>
                        </form>
                        <form method="POST" action="" class="action">
                            <input type="hidden" name="password" value="<?php echo PASSWORD; ?>">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="text" name="firstName"
                                value="<?php echo htmlspecialchars($employee['firstName']); ?>" required>
                            <input type="text" name="lastName"
                                value="<?php echo htmlspecialchars($employee['lastName']); ?>" required>
                            <input type="text" name="title" value="<?php echo htmlspecialchars($employee['title']); ?>"
                                required>
                            <input type="number" name="age" value="<?php echo htmlspecialchars($employee['age']); ?>"
                                required>
                            <input type="date" name="dateHired"
                                value="<?php echo htmlspecialchars($employee['dateHired']); ?>" required>
                            <input type="date" name="dateFired"
                                value="<?php echo htmlspecialchars($employee['dateFired']); ?>">
                            <input type="number" name="successes"
                                value="<?php echo htmlspecialchars($employee['successes']); ?>" required>
                            <label><input type="checkbox" name="hasComputer"
                                    <?php echo $employee['hasComputer'] ? 'checked' : ''; ?>> Has Computer</label>
                            <input type="number" name="activity"
                                value="<?php echo htmlspecialchars($employee['activity']); ?>" required>
                            <button type="submit">Save</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form method="POST" action="">
            <input type="hidden" name="password" value="<?php echo PASSWORD; ?>">
            <input type="hidden" name="action" value="sort">
            <label>Sort by: </label>
            <select name="sortType">
                <option value="name">Name</option>
                <option value="dateHired">Date Hired</option>
            </select>
            <button type="submit">Sort</button>
        </form>
        <form method="POST" action="">
            <input type="hidden" name="password" value="<?php echo PASSWORD; ?>">
            <input type="hidden" name="action" value="search">
            <input type="text" name="searchValue" placeholder="Search by name or date hired">
            <button type="submit">Search</button>
        </form>
    </div>
</body>

</html>
<?php
    return ob_get_clean();
}
?>