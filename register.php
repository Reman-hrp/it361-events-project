<?php
include "data/events-data.php";
$fullName = "";
$studentId = "";
$email = "";
$selectedEventId = "";
$errors = [];
$successMessage = "";

if (isset($_GET["event"])) {
    $selectedEventId = trim($_GET["event"]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = trim($_POST["fullName"] ?? "");
    $studentId = trim($_POST["studentId"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $selectedEventId = trim($_POST["eventId"] ?? "");

    if ($fullName === "") {
        $errors["fullName"] = "Full name is required.";
    } elseif (strlen($fullName) < 3) {
        $errors["fullName"] = "Full name must contain at least 3 characters.";
    }

    if ($studentId === "") {
        $errors["studentId"] = "Student ID is required.";
    } elseif (!preg_match("/^[A-Za-z0-9-]{4,20}$/", $studentId)) {
        $errors["studentId"] = "Student ID must contain 4 to 20 letters, numbers, or hyphens.";
    }

    if ($email === "") {
        $errors["email"] = "Email address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Please enter a valid email address.";
    }

    $selectedEvent = null;

    foreach ($events as $event) {
        if ((string) $event["eventId"] === $selectedEventId) {
            $selectedEvent = $event;
            break;
        }
    }

    if ($selectedEventId === "") {
        $errors["eventId"] = "Please select an event.";
    } elseif ($selectedEvent === null) {
        $errors["eventId"] = "The selected event is not valid.";
    }

    if (empty($errors)) {
        $filePath = __DIR__ . "/data/registrations.csv";
        $fileIsEmpty = !file_exists($filePath) || filesize($filePath) === 0;

        $file = fopen($filePath, "a");

        if ($file !== false) {
            if ($fileIsEmpty) {
                fputcsv($file, [
                    "Full Name",
                    "Student ID",
                    "Email",
                    "Event ID",
                    "Event Title",
                    "Registration Date"
                ]);
            }

            fputcsv($file, [
                $fullName,
                $studentId,
                $email,
                $selectedEvent["eventId"],
                $selectedEvent["eventTitle"],
                date("Y-m-d H:i:s")
            ]);

            fclose($file);

            $successMessage = "Your registration has been submitted successfully.";

            $fullName = "";
            $studentId = "";
            $email = "";
            $selectedEventId = "";
        } else {
            $errors["general"] = "The registration could not be saved. Please try again.";
        }
    }
}

include "includes/header.php";
?>

<section class="register-for-event">
    <div class="container">
        <div class="register-card">
            <span class="register-label">
                Student Registration
            </span>

            <h2>Register for an Event</h2>

            <p class="register-description">
                Complete the form below to register for one of the available campus events.
            </p>

            <?php if ($successMessage !== ""): ?>
                <div class="register-success">
                    <?php echo htmlspecialchars($successMessage); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($errors["general"])): ?>
                <div class="register-error-message">
                    <?php echo htmlspecialchars($errors["general"]); ?>
                </div>
            <?php endif; ?>

            <form class="register-form" method="POST" action="register.php">

                <div class="registerform--group">
                    <label for="fullName">Full Name</label>
                    <input
                        type="text"
                        id="fullName"
                        name="fullName"
                        value="<?php echo htmlspecialchars($fullName); ?>"
                        placeholder="Enter your full name"
                    >

                    <?php if (isset($errors["fullName"])): ?>
                        <small class="registerfield-error">
                            <?php echo htmlspecialchars($errors["fullName"]); ?>
                        </small>
                    <?php endif; ?>
                </div>

                <div class="registerform--group">
                    <label for="studentId">Student ID</label>

                    <input
                        type="text"
                        id="studentId"
                        name="studentId"
                        value="<?php echo htmlspecialchars($studentId); ?>"
                        placeholder="Enter your student ID"
                    >

                    <?php if (isset($errors["studentId"])): ?>
                        <small class="registerfield-error">
                            <?php echo htmlspecialchars($errors["studentId"]); ?>
                        </small>
                    <?php endif; ?>
                </div>

                <div class="registerform--group">
                    <label for="email">Email Address</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?php echo htmlspecialchars($email); ?>"
                        placeholder="Enter your email address"
                    >

                    <?php if (isset($errors["email"])): ?>
                        <small class="registerfield-error">
                            <?php echo htmlspecialchars($errors["email"]); ?>
                        </small>
                    <?php endif; ?>
                </div>

                <div class="registerform--group">
                    <label for="eventId">Select Event</label>

                    <select id="eventId" name="eventId">
                        <option value="">Choose an Event</option>

                        <?php foreach ($events as $event): ?>
                            <option
                                value="<?php echo $event["eventId"]; ?>"
                                <?php
                                if ((string) $event["eventId"] === $selectedEventId) {
                                    echo "selected";
                                }
                                ?>
                            >
                                <?php echo htmlspecialchars($event["eventTitle"]); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <?php if (isset($errors["eventId"])): ?>
                        <small class="registerfield-error">
                            <?php echo htmlspecialchars($errors["eventId"]); ?>
                        </small>
                    <?php endif; ?>
                </div>

                <button type="submit" class="register-submit">
                    Submit Registration
                </button>

            </form>
        </div>
    </div>
</section>

<?php include "includes/footer.php"; ?>