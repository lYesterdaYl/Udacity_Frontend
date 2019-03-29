<?php

include('../../../../system_files/inc.php');
include('include/function.php');

$ip = get_ip();

$check_ip = "select * from info where ip = '".$ip."'";
$result = $mysqli->query($check_ip);
$row = $result->fetch_array();

if($row['ip'] == ''){
    $url = "http://api.ipstack.com/".$ip."?access_key=".$access_key;
//    echo $url;
    $location = file_get_contents($url);
    $location = json_decode($location, TRUE);
}
else{
    $location['country_name'] = $row['country'];
    $location['region_name'] = $row['region'];
    $location['city'] = $row['city'];
    $location['zip'] = $row['zip'];

    $d = explode(",", $row['degree']);

    $location['latitude'] = $d[0];
    $location['longitude'] = $d[1];
}

//echo "<pre>";
//print_r($location);

$country = $location['country_name'];
$region = $location['region_name'];
$city = $location['city'];
$zip = $location['zip'];
$degree = $location['latitude'].", ".$location['longitude'];
$browser = get_browser();
$os = get_os();

if($ip != "192.168.1.1"){
    $sql = "insert into info (ip, browser, os, country, region, city, zip, degree) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssssss", $ip, $browser, $os, $country, $region, $city, $zip, $degree);
    $stmt->execute();
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Oliver's Portfolio Site</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/responsive.css">
        <link rel="icon" href="img/favicon.png">
    </head>
    <body>
        <header class="header">
            <div class="header_inner">
                <img class="header_logo" src="img/logo.jpg" alt="Zhiyuan Du's photo">
                <div class="header_info_container">
                    <div class="header_title">
                        Zhiyuan Du
                    </div>
                    <div class="header_job">
                        Full Stack Web Developer<br>
                    </div>

                </div>
                <div class="header_self_description">
                    <p>Hi! Welcome to my Portfolio website. I am a former core PHP Developer in an unmanned convinence store company in China. I have worked and finished multiple projects such as, unmanned Radio Frequency Identification & image identification fridge & a solo project on self-service market during my previous work. I am currently a UC Irvine student who will graduate next year, and I have completed the Front-End and Full-Stack Web Developer Program with Udacity(2 months each). As a graduate from the degree, I am confident on completing most Front-End and Back-End Tasks.
                    </p>
                </div>
            </div>
        </header>

        <main>
            <section class="content">
                <section class="education">
                    <h2 class="section_header">
                        EDUCATION
                    </h2>
                    <div class="section_content">
                        <div class="section_content_title">
                            University of California, Irvine
                        </div>

                        <div class="section_content_date">
                            Mar 2019<br>
                        </div>

                        <div class="section_content_info">
                            B.S, Information and Computer Science(ICS)<br>
                        </div>

                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            <br>Udacity
                        </div>

                        <div class="section_content_date">
	                        Aug 2018- Nov 2018<br>
                        </div>

                        <div class="section_content_info">
                            Front-End Web Developer Nanodegree Program<br>
	                        <a href="https://confirm.udacity.com/XDGLKMUK">Certificate of Completion</a><br>

                        </div>

	                    <div class="section_content_date">
		                    <br>Nov 2018- Jan 2019<br>
	                    </div>

	                    <div class="section_content_info">
		                    Full-Stack Web Developer Nanodegree Program<br>
		                    <a href="https://confirm.udacity.com/HAAV4GFK">Certificate of Completion</a><br>

	                    </div>

                    </div>

                </section>

                <section class="language_technologies">
                    <h2 class="section_header">
                        <br>STRENGTHS & SKILLS
                    </h2>
                    <div class="section_content">
                        <div class="section_content_title">
                            Technical Skill
                        </div>
                        <div class="section_content_info">
                            PHP, Python, SQL, Redis, Memcached, JavaScript, HTML, CSS, WeChat Mini Program, C++, Java, Git, Unit Testing, Flask, SqlAlchemy, Django, Scrapy, Linux Command, BootStrap, Jquery
                        </div>

                        <div class="section_content_title">
                            <br>Languages
                        </div>
                        <div class="section_content_info">
                            Mandarin Chinese, Cantonese Chinese
                        </div>

                    </div>
                </section>

                <section class="experience">
                    <h2 class="section_header">
                        <br>EXPERIENCE
                    </h2>
                    <div class="section_content">
                        <img src="img/easygo_ico.png" class="section_content_logo_1" alt="easyo logo">
                        <div class="section_content_title">
                            Guangzhou ZaoJiu Ltd (EasyGo)
                        </div>
                        <div class="section_content_date">
                            Sep 2017- July 2018<br>
                        </div>

                        <div class="section_content_info">
                            Software Engineer<br>
                            Website: http://www.ieasygo.cn/<br>
                            •	Updated and maintained EasyGo unmanned convenience store Amazed UI framework management system.<br>
                            •	Designed and developed frontend application and many backend APIs for EasyGo WeBox unmanned fridge project.<br>
                            •	Solely designed and developed frontend application, countless backend API and management system for EasyGo Self-Service Market project.<br>
                            •	Improved and optimized management system performance by 50%.<br>
                        </div>
                    </div>

                    <div class="section_content">
                        <img src="img/icbc_ico.png" class="section_content_logo_2" alt="easyo logo" >
                        <div class="section_content_title">
                            Industrial and Commercial Bank of China (ICBC)
                        </div>

                        <div class="section_content_date">
                            June 2014- Aug 2014<br>
                        </div>

                        <div class="section_content_info">
                            Software Engineer<br>
                            •	Developed backend APIs for an IOS bank assistant app.<br>
                            •	Updated and maintained management system's various API.<br>
                        </div>
                    </div>

                </section>

                <section class="projects">
                    <h2 class="section_header">
                        <br>PROJECTS
                    </h2>

                    <div class="section_content">
                        <div class="section_content_title">
                            Movie Search Engine App
                        </div>

                        <div class="section_content_date">
                            Jan 2019 – Mar 2019<br>
                        </div>

                        <div class="section_content_info">
                            <a href="https://github.com/lYesterdaYl/Movie_Search_Engine">Github</a><br>
                            • Using imdb movie data to implement an inverted index using MySQL.<br>
                            • Deploy the search engine on a flask server for user to find movie data with their query.<br>
                            • Reached 90% result accuracy with fast query speed.<br>
                            • Skill: HTML, Python, Flask, AWS, MySQL, SQLalchemy, Scrapy<br>
                        </div>
                    </div>

	                <div class="section_content">
		                <div class="section_content_title">
                            <br>Item Catalog
		                </div>

		                <div class="section_content_date">
			                Nov 2018 – Jan 2019<br>
		                </div>

		                <div class="section_content_info">
			                <a href="https://github.com/lYesterdaYl/Udacity_FullStack/tree/master/Item%20Catalog">Github</a><br>
			                • Developed a webpage management application for user to modify item information in the database<br>
			                • Skill: Python, HTML, JavaScript, MySQL, Flask<br>
		                </div>
	                </div>

	                <div class="section_content">
		                <div class="section_content_title">
			                <br>WebReg_Collector
		                </div>

		                <div class="section_content_date">
			                Dec 2018 – Dec 2018<br>
		                </div>

		                <div class="section_content_info">
			                <a href="https://github.com/lYesterdaYl/WebReg_Collector">Github</a><br>
			                • Developed a sample web crawler that collect class available information from class schedule website<br>
			                • Implemented function to notify user through email when there is available spot for a class<br>
			                • Skill: PHP, MySQL<br>
		                </div>
	                </div>

	                <div class="section_content">
		                <div class="section_content_title">
			                <br>Wumpus World AI
		                </div>

		                <div class="section_content_date">
			                Oct 2018 – Nov 2018<br>
		                </div>

		                <div class="section_content_info">
			                <a href="https://github.com/lYesterdaYl/W_World">Github</a><br>
			                • Developed and implemented an AI for a classic game calls Wumpus World for my AI Project class.<br>
			                • Prototype AI can score average of 230 points, which is 30 points more than the project full credit requirement.<br>
			                • Skill: Python<br>
		                </div>
	                </div>

	                <div class="section_content">
		                <div class="section_content_title">
			                <br>Process Scheduling Algorithms
		                </div>

		                <div class="section_content_date">
			                Nov 2018 – Nov 2018<br>
		                </div>

		                <div class="section_content_info">
			                <a href="https://github.com/lYesterdaYl/Process-Scheduling-Algorithms">Github</a><br>
			                • Developed a program to compare the performance of several process scheduling algorithms.<br>
			                • Skill: Java<br>
		                </div>
	                </div>

	                <div class="section_content">
		                <div class="section_content_title">
			                <br>Logs Analysis
		                </div>

		                <div class="section_content_date">
			                Nov 2018 – Nov 2018<br>
		                </div>

		                <div class="section_content_info">
			                <a href="https://github.com/lYesterdaYl/Udacity_FullStack/tree/master/Logs%20Analysis">Github</a><br>
			                • Developed a program that prints out data according to requirement.<br>
			                • Skill: Python, Postgresql<br>
		                </div>
	                </div>

	                <div class="section_content">
		                <div class="section_content_title">
			                <br>Restaurant Review App
		                </div>

		                <div class="section_content_date">
			                Oct 2018 – Nov 2018<br>
		                </div>

		                <div class="section_content_info">
			                <a href="https://github.com/lYesterdaYl/Udacity_Frontend/tree/master/Restaurant%20Review%20App">Github</a><br>
			                <a href="www.ordinaryzone.com/Restaurant_Review_App/">Online Version</a><br>
			                • Developed a Restaurant Review App that allows users to browse nearby restaurant user reviews and rating with responsive design(Mobile & Desktop)<br>
			                • Implemented with service worker which improves user experience while offline or having slow network.<br>
			                • Skill: HTML, JavaScript, CSS, Accessibility, Service Worker<br>
		                </div>
	                </div>

                    <div class="section_content">
                        <div class="section_content_title">
	                        <br>File System
                        </div>

                        <div class="section_content_date">
                            Oct 2018 – Oct 2018<br>
                        </div>

                        <div class="section_content_info">
                            <a href="https://github.com/lYesterdaYl/File_System">Github</a><br>
                            • Developed a file system.<br>
                            • The user interacts with the file system using commands, such as create, open, or read file from disk.<br>
                            • Skill: Java<br>
                        </div>
                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            <br>Classic Arcade Game
                        </div>

                        <div class="section_content_date">
                            Sep 2018 – Sep 2018<br>
                        </div>

                        <div class="section_content_info">
                            <a href="https://github.com/lYesterdaYl/Udacity_Frontend/tree/master/Classic%20Arcade%20Game%20Clone">Github</a><br>
                            <a href="www.ordinaryzone.com/Classic_Arcade_Game/">Online Version</a><br>
                            • Developed a classical game that allows players to collect gems on the road where bugs can kill player and reset the game. Player wins if they collected enough gems.<br>
                            • The game was developed with Object-Oriented-Programming within 2 days.<br>
                            • Skill: JavaScript, HTML5 Canvas, BootStrap, Jquery, HTML, CSS<br>
                        </div>
                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            <br>Memory Game
                        </div>

                        <div class="section_content_date">
                            Aug 2018 – Sep 2018<br>
                        </div>

                        <div class="section_content_info">
                            <a href="https://github.com/lYesterdaYl/Udacity_Frontend/tree/master/Memory%20Game">Github</a><br>
                            <a href="www.ordinaryzone.com/Memory_Game/">Online Version</a><br>
                            •	Developed and Designed a memory game for Udacity NanoDegree Project<br>
                            •	Developed functions with JavaScript to perform feature<br>
                            •	The game has responsive design across phone, tablet, and desktop<br>
                            •	Skill: JavaScript, HTML, CSS<br>
                        </div>
                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            <br>Portfolio Site
                        </div>

                        <div class="section_content_date">
                            Aug 2018 – Aug 2018<br>
                        </div>

                        <div class="section_content_info">
                            <a href="https://github.com/lYesterdaYl/Udacity_Frontend/tree/master/Portfolio%20Site">Github</a><br>
                            <a href="www.ordinaryzone.com/Portfolio_Site/">Online Version</a><br>
                            •	Developed and Designed a personal website for Udacity NanoDegree Project<br>
                            •	Developed page with responsive design for phone, tablet, and desktop<br>
                            •	Used PHP and MySQL to keep track of visitor's information upon visiting the website<br>
                            •	Skill: PHP, MySQL, HTML, CSS<br>
                        </div>
                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            <br>EasyGo Image Identification Fridge(WeBox)
                        </div>

                        <div class="section_content_date">
                            April 2018 – July 2018<br>
                        </div>

                        <div class="section_content_info">
                            •	Developed and updated the Radio Frequency Identification(RFID) Fridge's code to work with both the Image Identification Fridge's hardware and RFID Fridge.<br>
                            •	Developed a debug system to record information from the Fridge payment procedure.<br>
                            •	Using Google TensorFlow Model Project to achieve image identification function.<br>
                            •	Gained experience on how to label the object efficiently and increase the identification accuracy.<br>
                            •	Skill: PHP, JavaScript, MySQL, Redis, Laravel<br>
                        </div>
                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            <br>EasyGo Market
                        </div>

                        <div class="section_content_date">
                            Nov 2017 – Dec 2017<br>
                        </div>

                        <div class="section_content_info">
                            •	Solely Designed and developed a Wechat HTML5 mini-program base application that allows customers to scan products' barcode to achieve shopping through their phone.<br>
                            •	Designed and developed Application's UI by Wechat mini-program IDE. It is a JavaScript base developer tool.<br>
                            •	Developed Management system with Amazed UI framework.<br>
                            •	Backend APIs for the mini-program and management system are written by PHP to interface SQL database.<br>
                            •	Whole set of the project has already submitted for intellectual property review.<br>
                            •	Skill: PHP, JavaScript, MySQL<br>
                        </div>
                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            <br>EasyGo Radio Frequency Identification Fridge(WeBox)
                        </div>

                        <div class="section_content_date">
                            Dec 2017 – March 2018<br>
                        </div>

                        <div class="section_content_info">
                            •	Designed and developed a Wechat HTML5 mini-program base application that allows customers to buy products from the fridge with just 3 simple steps: open, take and go.<br>
                            •	Data storage method involving Memcache and SQL.<br>
                            •	Backend APIs are written by PHP to interface Memcache and SQL database.<br>
                            •	Skill: PHP, JavaScript, MySQL, Memcache, Redis, Laravel<br>
                        </div>
                        <div class="section_content_img">
                            <img src="img/webox.png" alt="image of webox">
                            <div class="section_content_img_info">
                                Webox
                            </div>
                        </div>
                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            <br>EasyGo Notification System
                        </div>

                        <div class="section_content_date">
                            Dec 2017 – Dec 2017<br>
                        </div>

                        <div class="section_content_info">
                            •	Developed an effective system failure notification solution for Unmanned convenience store and Unmanned Fridge.<br>
                            •	Using Linux Tool crontab to run various PHP API to diagnosis system data's correctness after a set period of time.<br>
                            •	Use Wechat push function to push information to certain administrative staff's Wechat account if errors were found.<br>
                            •	Skill: PHP, MySQL, Crontab, Wechat API<br>
                        </div>
                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            <br>Web Crawler
                        </div>

                        <div class="section_content_date">
                            April 2017<br>
                        </div>

                        <div class="section_content_info">
                            •	Used Scrapy module to capture more than 5000 unique school domain's sub-website links.<br>
                            •	Did data analysis for each webpage in order to find more website link in each webpage's raw data.<br>
                            •	Skill: Python, PHP<br>
                        </div>
                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            <br>Search Engine
                        </div>

                        <div class="section_content_date">
                            Mar 2017<br>
                        </div>

                        <div class="section_content_info">
	                        <a href="https://github.com/lYesterdaYl/Search-Engine">Github</a><br>
	                        •	Created an index based search engine using lucene Py.<br>
                            •	Currently using Stop words analyzer, which improved the search engine performance.<br>
                            •	Data storage type using JSON.<br>
                            •	Search engine has HTML homepage for searching.<br>
                            •	Skill: Python, PHP<br>
                        </div>
                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            <br>MediPal
                        </div>

                        <div class="section_content_date">
                            Nov 2016<br>
                        </div>

                        <div class="section_content_info">
                            •	A medical use app that helps children to understand their procedure with a fun interacting way before they undergo the procedure.<br>
                            •	The app was created with a team of six people during Med AppJam.<br>
                            •	Med AppJam was an only 2-week app tournament for a group of students to produce a medical related app.<br>
                            •	Skill: Swift<br>
                        </div>
                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            <br>Inheritance and Simulation
                        </div>

                        <div class="section_content_date">
                            Nov 2015<br>
                        </div>

                        <div class="section_content_info">
                            •	Created a simulated universe game using tkinter. Allow players to add custom number of different objects into the universe.<br>
                            •	Additional objects with different characteristics can be added into the game.<br>
                            •	Skill: Python<br>
                        </div>
                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            <br>ICBC Finance App
                        </div>

                        <div class="section_content_date">
                            June 2014- Aug 2015<br>
                        </div>

                        <div class="section_content_info">
                            •	Developed APIs for a finance assistant app that achieve various required functions.<br>
                            •	Skill: PHP<br>
                        </div>
                    </div>

                </section>

                <section class="additional_skills">
                    <h2 class="section_header">
                        <br>ADDITIONAL SKILLS
                    </h2>
                    <div class="section_content">
                        <div class="section_content_info">
                            •	Mandarin, Cantonese Speaker<br>
                            •	Windows, Mac OS, Linux<br>
                        </div>

                    </div>
                </section>

                <section class="awards">
                    <h2 class="section_header">
                        <br>Awards
                    </h2>
                    <div class="section_content">
                        <div class="section_content_info">
                            •	Med AppJam: Most Startup Potential(MediPal)<br>
                                Nov 2016<br>
                        </div>

                    </div>
                </section>
            </section>


            <footer>
                <ul>
                    <li>Contact me: dzyoliver@gmail.com</li>
                    <li><a href="https://github.com/lYesterdaYl">Find me on GitHub</a></li>
                </ul>
            </footer>


        </main>








    </body>
</html>