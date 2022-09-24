<!DOCTYPE html>
<html>

<head>
    <title>My Page</title>
    <link rel="stylesheet" href="data/fonts/Satoshi-Regular.otf">
    <link rel="stylesheet" href="data/styles/main.css">
    <link rel="stylesheet" href="data/styles/common.css">

<body class="deep-gray">
    <div class="container">
        <div class="fourth vertical-container transparent contact-overview">
            <div class="personal-info">
                <div>
                    <img src="data/img/photo.jpg" style="width: 100%" alt=" photo">
                </div>
                <h2 class="medium-gray">Yaroslav Nazarenko</h2>
                <h3 class="medium-gray">Software Engineer</h3>
                <div class="contact-info">
                    <div class="contact-info-item">
                        <img src="data/img/phone.png" alt="phone">
                        <p class="medium-gray">+380 98 986 62 09</p>
                    </div>
                    <div class="contact-info-item">
                        <img src="data/img/mail.png" alt="mail">
                        <p class="medium-gray">yaroslav.naz14@gmail.com</p>
                    </div>
                    <div class="divider"></div>
                    <div class="contact-info-item">
                        <img src="data/img/location.png" alt="location">
                        <p class="medium-gray">Cherkasy, Ukraine</p>
                    </div>
                    <div class="divider"></div>
                    <div class="vertical-container contact-info-item">
                        <h3>Skills</h3>
                        <p class="medium-gray">C#, C++, Java, Python, JavaScript, HTML, CSS, SQL, Git, Linux</p>
                    </div>
                    <div class="divider"></div>
                    <div class="vertical-container contact-info-item">
                        <h3>Languages</h3>
                        <p class="medium-gray">Ukrainian, English</p>
                    </div>
                </div>
            </div>

            <div class="email-me contact-info-item ">
                <h2>
                    <img src="./data/img/envelope.png" alt="envelpe">
                    <p>Write me an email</p>
                </h2>
                <form onsubmit="handleEmailSend(event);">
                    <div class="email">
                        <label for="id-sender-name">Your Name</label>
                        <input type="text" id="id-sender-name" required>
                        <label for="id-sender-email">Your email</label>
                        <input type="text" id="id-sender-email" required>
                        <label for="id-message">Your message</label>
                        <textarea id="id-message" required></textarea>
                        <button id="id-send-button" type="submit">Send</button>
                        <p>*You may need to check the spam folder</p>

                        <p style="margin-top: 5px;" class="email-sent-message" hidden>The message was sent.</p>
                    </div>
                </form>

            </div>
        </div>

        <div class=" three-fourth vertical-container transparent main">
            <div class="vertical-container" style="margin-top: 0;">
                <h2 class="medium-gray">
                    <img src="data/img/education.png" alt="education">
                    Education
                </h2>
                <div class="vertical-container">
                    <h3 class="medium-gray">Cherkasy National University</h3>
                    <p class="medium-gray">Bachelor of Computer Science</p>
                    <p class="medium-gray">2019 - now</p>
                </div>
            </div>
            <div class="vertical-container">
                <h2 class="medium-gray">
                    <img src="data/img/work.png" alt="work">
                    Experience
                </h2>
                <div class="vertical-container">
                    <h3 class="medium-gray">Software Engineer</h3>
                    <p class="medium-gray">Avenga</p>
                    <p class="medium-gray">2019 - Present</p>
                </div>
            </div>
            <div class="vertical-container">
                <h2 class="medium-gray">Projects</h2>
                <h3 class="medium-gray">
                    <a href="./lab2/lab2.php">Lab 2</a>
                </h3>
                <p class="medium-gray">Shows population, number of institutions of higher education, and number of institutions of higher education per 100k citizens.</p>
                <div class="divider"></div>
                <h3 class="medium-gray">
                    <a href="./lab3/lab3.php">Lab 3</a>
                </h3>
                <p class="medium-gray">Shows average score of students who applied for grants, number of students who applied for grants, shortage, number of contract students and name of the university by selected specialization.</p>
                <div class="divider"></div>
                <h3 class="medium-gray">
                    <a href="./lab4/lab4.php">Lab 4</a>
                </h3>
                <p class="medium-gray">Shows population, number of institutions of higher education and number of institutions of higher education per 100k citizens, by selected region.</p>
                <div class="divider"></div>
                <h3 class="medium-gray">
                    <a href="./lab5/lab5.php">Lab 5</a>
                </h3>
                <p class="medium-gray">Displays weather info for city of Kharkiv for the current date, parsed from Gismeteo website.</p>
                <div class="divider"></div>
                <h3 class="medium-gray">
                    <a href="./lab6/lab6.php">Lab 6</a>
                </h3>
                <p class="medium-gray">Displays weather info for ceveral cities for the current date, parsed from Gismeteo website in a form of images.</p>
                <div class="divider"></div>
                <h3 class="medium-gray">
                    <a href="./lab7/lab7.php">Lab 7</a>
                </h3>
                <p class="medium-gray">Enables to look up the data from santehtochka.com.ua website by given keyword.</p>
                <div class="divider"></div>
                <h3 class="medium-gray">
                    <a href="./lab8/lab8.php">Lab 8</a>
                </h3>
                <p class="medium-gray">Gives the information about an IP address.</p>
            </div>
        </div>
    </div>
</body>

<script src="data/js/main.js"></script>

</html>