
<?php
include "includes/header.php";
include "data/events-data.php";
?>

<section class="events-page">
    <div class="container">
        <div class="events-heading">
            <span class="events-label">SEU Activities</span>
            <h2>All Upcoming Events</h2>
              <p>
            All the activities of the Saudi Electronic University will be displayed on this page, 
            so that students can view and browse them easily.
        </p>
        </div>

        <div class="events-container">
            <?php foreach ($events as $event): ?>
                <article class="events-pcard">
                    <span class="events-pcategory">
                        <?php echo $event["eventCategory"]; ?>
                    </span>

                    <h3>
                        <?php echo $event["eventTitle"]; ?>
                    </h3>

                    <p class="events-description">
                        <?php echo $event["eventDescription"]; ?>
                    </p>

                    <div class="events-info">
                        <p>
                            <strong>Date:</strong>
                            <?php echo $event["eventDate"]; ?>
                        </p>

                        <p>
                            <strong>Time:</strong>
                            <?php echo $event["eventTime"]; ?>
                        </p>

                        <p>
                            <strong>Location:</strong>
                            <?php echo $event["eventLocation"]; ?>
                        </p>
                    </div>

                    <a
                        href="event.php?id=<?php echo $event["eventId"]; ?>"
                        class="events-btn"
                    >
                        View Details
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include "includes/footer.php"; ?>