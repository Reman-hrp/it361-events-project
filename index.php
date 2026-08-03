<?php
include "includes/header.php";
include "data/events-data.php";
?>
<section class="index-container">
    <div class="index-card">
        <span class="index-label">Saudi Electronic University</span>
        <h2>Welcome to SEU Campus Events</h2>
        <p>
            From here, you can discover everything related to university events and 
            register for them easily through the online platform for campus events.
        </p>
        <a href="events.php" class="first-btn">Explore Events</a>
    </div>
</section>

<section class="three-events-section">
    <div class="container">
        <h2 class="section-title">
            Upcoming Events
        </h2>
        <div class="events-con">
            <?php foreach(array_slice($events,0,3) as $event): ?>
                <div class="event-card">
                    <span class="events-category">
                        <?php echo $event["eventCategory"]; ?>
                    </span>

                    <h3>
                        <?php echo $event["eventTitle"]; ?>
                    </h3>

                    <p>
                        <?php echo $event["eventDescription"]; ?>
                    </p>

                    <div class="event-details">

                        <span>
                             <?php echo $event["eventDate"]; ?>
                        </span>

                        <span>
                             <?php echo $event["eventLocation"]; ?>
                        </span>

                    </div>

                    <a href="event.php?id=<?php echo $event["eventId"]; ?>">
                        View Details
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="view-all-btn">
            <a href="events.php" class="scnd-btn">
                View All Events
            </a>
        </div>
    </div>
 </section>
<?php include "includes/footer.php"; ?>