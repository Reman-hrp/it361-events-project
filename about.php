<?php
$name = "";
$email = "";
$message = "";
$errors = [];
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "") {
        $errors["name"] = "Name is required.";
    } elseif (strlen($name) < 3) {
        $errors["name"] = "Name must contain at least 3 characters.";
    }

    if ($email === "") {
        $errors["email"] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Please enter a valid email address.";
    }

    if ($message === "") {
        $errors["message"] = "Message is required.";
    } elseif (strlen($message) < 10) {
        $errors["message"] = "Message must contain at least 10 characters.";
    }

    if (empty($errors)) {

        $successMessage = "Your message has been received successfully.";

        $name = "";
        $email = "";
        $message = "";
    }
}

include "includes/header.php";

?>

<section class="about-page">

    <div class="container">
        <div class="about-card">
            <span class="about-label">
                About the Project
            </span>

            <h2>About</h2>
            <p class="about-description">
                This website was developed as part of the IT361 Web Technologies course.
            </p>

            <div class="about-member">
                <h3>Student Information</h3>
                <ul>
                    <li><strong>Name:</strong> Reman Khalid Al harbi</li>
                    <li><strong>Course:</strong> IT361 - Web Technologies</li>
                    <li><strong>University:</strong> Saudi Electronic University</li>
                </ul>
            </div>
            <hr>

            <div class="contact-section">
                <h3>Contact Form</h3>
                <?php if ($successMessage !== ""): ?>
                    <div class="about-success">
                    <?php echo htmlspecialchars($successMessage); ?>
                    </div>

                <?php endif; ?>

                <form method="POST" class="about-form">
                    <div class="contact-form">
                        <label for="name">
                            Name
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="<?php echo htmlspecialchars($name); ?>"
                            placeholder="Enter your name"
                        >

                        <?php if(isset($errors["name"])): ?>
                            <small class="about-error">
                            <?php echo htmlspecialchars($errors["name"]); ?>
                            </small>
                        <?php endif; ?>
                    </div>

                    <div class="contact-form">
                        <label for="email">
                            Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?php echo htmlspecialchars($email); ?>"
                            placeholder="Enter your email"
                        >

                        <?php if(isset($errors["email"])): ?>
                            <small class="about-error">
                                <?php echo htmlspecialchars($errors["email"]); ?>
                            </small>
                        <?php endif; ?>

                    </div>
                    <div class="contact-form">
                        <label for="message">
                            Message
                        </label>
                        <textarea
                            id="message"
                            name="message"
                            rows="5"
                            placeholder="Write your message"
                        ><?php echo htmlspecialchars($message); ?></textarea>
                        <?php if(isset($errors["message"])): ?>
                            <small class="about-error">
                            <?php echo htmlspecialchars($errors["message"]); ?>
                            </small>
                        <?php endif; ?>
                    </div>

                    <button
                        type="submit"
                        class="about-btn"
                    >
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include "includes/footer.php"; ?>