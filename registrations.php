<?php
$registrations = [];
$filePath = __DIR__ . "/data/registrations.csv";

if (file_exists($filePath) && filesize($filePath) > 0) {
    $file = fopen($filePath, "r");

    if ($file !== false) {
        $headers = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) >= 6) {
                $registrations[] = [
                    "fullName" => $row[0],
                    "studentId" => $row[1],
                    "email" => $row[2],
                    "eventId" => $row[3],
                    "eventTitle" => $row[4],
                    "registrationDate" => $row[5]
                ];
            }
        }

        fclose($file);
    }
}

include "includes/header.php";
?>

<section class="registrations-page">
    <div class="container">

        <div class="registrations-heading">
            <span class="registrations-label">
                Registration Records
            </span>
        <p>
            All students registered for Saudi Electronic University events 
            will have their registrations displayed here.
        </p>
        </div>

        <?php if (!empty($registrations)): ?>
            <div class="registrations-table-container">
                <table class="registrations-table">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Student ID</th>
                            <th>Email</th>
                            <th>Event</th>
                            <th>Registration Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($registrations as $registration): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($registration["fullName"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($registration["studentId"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($registration["email"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($registration["eventTitle"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($registration["registrationDate"]); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>

            <div class="no-registrations">
                <h3>No Registrations Yet</h3>

                <p>
                    No students have registered for an event yet.
                </p>

                <a href="register.php" class="registrations-btn">
                    Register for an Event
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include "includes/footer.php"; ?>