<?php
include "includes/header.php";
include "data/events-data.php";

$eventId = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
$selectedEvent = null;

foreach ($events as $event) {
    if ($event["eventId"] === $eventId) {
        $selectedEvent = $event;
        break;
    }
}
?>

<section class="event-details-page">
    <div class="container">
        <?php if ($selectedEvent): ?>
            <div class="event-card-page">
                <span class="event-category-page">
                    <?php echo htmlspecialchars($selectedEvent["eventCategory"]); ?>
                </span>

                <h2>
                    <?php echo htmlspecialchars($selectedEvent["eventTitle"]); ?>
                </h2>

                <p class="event-description-page">
                    <?php echo htmlspecialchars($selectedEvent["eventDescription"]); ?>
                </p>

                <div class="event-information-page">

                    <div class="information-item-page">
                        <h3>Date</h3>
                        <p>
                            <?php echo htmlspecialchars($selectedEvent["eventDate"]); ?>
                        </p>
                    </div>

                    <div class="information-item-page">
                        <h3>Time</h3>
                        <p>
                            <?php echo htmlspecialchars($selectedEvent["eventTime"]); ?>
                        </p>
                    </div>

                    <div class="information-item-page">
                        <h3>Location</h3>
                        <p>
                            <?php echo htmlspecialchars($selectedEvent["eventLocation"]); ?>
                        </p>
                    </div>

                </div>

                <div class="event-actions-page">
                    <a
                        href="register.php?event=<?php echo $selectedEvent["eventId"]; ?>"
                        class="register-event-btn"
                    >
                        Register Now
                    </a>

                    <a href="events.php" class="back-events-btn">
                        Back to Events
                    </a>

                </div>

            </div>

        <?php else: ?>
            <div class="event-error">
                <h2>Event Not Found</h2>
                <p>
                    The selected event does not exist.
                </p>
                <a href="events.php" class="back-events-btn">
                    View All Events
                </a>
            </div>

        <?php endif; ?>
    </div>
</section>
<?php include "includes/footer.php"; ?>