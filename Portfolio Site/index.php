<?php

include('../../../../system_files/inc.php');
include('include/function.php');

$ip = get_ip();

$check_ip = "select * from woe_info where ip = '".$ip."'";
$result = $mysqli->query($check_ip);
$row = $result->fetch_array();

if($row['ip'] == ''){
    $location = file_get_contents("http://api.ipstack.com/".$ip."?access_key=".$access_key);
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

//$location = file_get_contents("https://ipstack.com/ipstack_api.php?ip=".$ip);
$location = json_decode($location);
$country = $location->country_name;
$region = $location->region_name;
$city = $location->city;
$zip = $location->zip;
$degree = $location->latitude.", ".$location->longitude;
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
                        PHP Back-End Developer<br>
                    </div>

                </div>
                <div class="header_self_description">
                    <p>Hi! Welcome to my Portfolio website. I am a former core PHP Developer in an unmanned convinence store company in China. I have worked and finished multiple projects such as, unmanned Radio Frequency Identification & image identification fridge & a solo project on self-service market during my previous work. I am currently a UC Irvine student who will graduate next year, and I am studying Front-End in the Udacity Front-End Web Developer Program. During the nanodegree with Udacity, I have completed 2 projects with few weeks ahead the deadline, and I got great feedback from the reviewer. I believe I can do well on Front-End tasks upon completing this degree. I also have the aspiration to take the Full-Stack Developer program soon, to improve my deeper knowledge of web development with various programming languages.
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
                            Sep 2014 - June 2017<br>
                            July 2018 - June 2019<br>
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
                            Aug 2018 - Present<br>
                        </div>

                        <div class="section_content_info">
                            Front-End Web Developer Nanodegree Program<br>
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
                            Software Designer, PHP Developer(Full-time)<br>
                            Website: http://www.ieasygo.cn/<br>
                            •	Updated and maintained EasyGo unmanned convenience store Amazed UI framework management system.<br>
                            •	Designed and developed frontend application and many backend APIs for EasyGo WeBox unmanned fridge project.<br>
                            •	Solely designed and developed frontend application, countless backend API and management system for EasyGo Self-Service                                 Market project.<br>
                            •	Updated and developed APIs for EasyGo Laravel framework new management system.<br>
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
                            PHP Developer Intern<br>
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
                            Classic Arcade Game
                        </div>

                        <div class="section_content_date">
                            Sep 2018 – Sep 2018<br>
                        </div>

                        <div class="section_content_info">
                            <a href="https://github.com/lYesterdaYl/Udacity_Frontend/tree/master/Classic%20Arcade%20Game%20Clone">Github</a><br>
                            <a href="http://97.90.19.113/Classic_Arcade_Game/">Online Version</a><br>
                            • Developed a classical game that allows players to collect gems on the road where bugs can kill player and reset the game. Player wins if they collected enough gems.<br>
                            • The game was developed with Object-Oriented-Programming within 2 days.<br>
                            • Skill: JavaScript, HTML5 Canvas, BootStrap, Jquery, HTML, CSS<br>
                        </div>
                    </div>

                    <div class="section_content">
                        <div class="section_content_title">
                            Memory Game
                        </div>

                        <div class="section_content_date">
                            Aug 2018 – Sep 2018<br>
                        </div>

                        <div class="section_content_info">
                            <a href="https://github.com/lYesterdaYl/Udacity_Frontend/tree/master/Memory%20Game">Github</a><br>
                            <a href="http://97.90.19.113/Memory_Game/">Online Version</a><br>
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
                            <a href="http://97.90.19.113/Portfolio_Site/">Online Version</a><br>
                            •	Developed and Designed a personal website for Udacity NanoDegree Project<br>
                            •	Developed page with responsive design for phone, tablet, and desktop<br>
                            •	Used PHP to keep track of vister's information upon visiting the website<br>
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

                <section class="language_technologies">
                    <h2 class="section_header">
                        <br>LANGUAGES & TECHNOLOGIES
                    </h2>
                    <div class="section_content">
                        <div class="section_content_info">
                            •	Python: 1 year(experienced)<br>
                            •	PHP: 2 years (proficient)<br>
                            •	MySQL: 1 years(experienced)<br>
                            •	HTML: 1 years(experienced)<br>
                            •	Java Script: 6 months(ordinary)<br>
                            •	C++: 6 months(ordinary)<br>
                            •	Java: 6 months(ordinary)<br>
                            •	Swift: 1 months(ordinary)<br>
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
                    <li>Contact me: zhiyuad@easygo.mobi</li>
                    <li><a href="https://github.com/lYesterdaYl">Find me on GitHub</a></li>
                </ul>
            </footer>


        </main>








    </body>
</html>