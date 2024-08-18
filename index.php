<?php
session_start();
// include header 
include 'header.php'; ?>

<!---Home section-->
<section class="home" id="home">
    <div class="home-content">
        <h3>Hello, I am </h3>
        <h1>Mohd Kaif</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br> 
            Voluptate est reiciendis amet in quasi, nihil error</br> consequuntur labore saepe doloremque. 
            Ad </br>doloremque laudantium quod adipisci deserunt</br>odit minus natus reprehenderit?
        </p>
        <div class="social-media">
            <a href="#"><i class="fa-brands fa-square-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
        </div>
        <a href="register.php" class="btn">Get Start</a>
    </div>
    <div class="profession-container">
        <div class="profession-box">
            <div class="profession" style="--i:1">
                <i class="fa-solid fa-web-awesome"></i>
                <h3>Web Desinger</h3>
            </div>
            <div class="profession" style="--i:2">
                <i class="fa-solid fa-desktop"></i>
                <h3>Computer H/W Eng</h3>
            </div>
            <div class="profession" style="--i:3">
                <i class="fa-solid fa-code"></i>
                <h3>Web Developer</h3>
            </div>
            <div class="circle"></div>
            
        </div>
        <div class="overlay"></div>
    </div>
</section>
<!---End Home section-->

<!--About Section-->
<section class="about" id="about">
    <?php 
        if(isset($_SESSION['user_role'])){
            $id = $_SESSION["user_id"];
            $db = new Database();
            $db->select('about','*','',"user_id=$id",'id Desc','');
            $about = $db->getResult();
            if($about > 0){
                foreach($about as $ab){
                    ?>
                    <div class="about-img">
                        <img src="<?php echo $hostname. '../profile/'.$ab['profile'] ?>" alt="Profile">
                    </div>
                    <div class="about-content">
                        <h2 class="heading">About <span>Me</span></h2>
                        <h3><?php echo $ab['sort_desc'] ?></h3>
                        <p>
                            <?php echo $ab['long_desc'] ?>
                        </p>
                        <a href="#" class="btn">Read More</a>
    
                    </div>
                    <?php
                }
            }
        }
        else{
            ?>
            <div class="about-img">
                <img src="<?php echo $hostname.'../profile/1723979174img2.png' ?>" alt="Profile">
            </div>
            <div class="about-content">
                <h2 class="heading">About <span>Me</span></h2>
                <h3>I am Web Developer and Compuer Hardware Enginer</h3>
                <p>Hello, I am Md Kaif
                I am a web developer use technology PHP language 
                and its frame work laravel developer i am also web
                 designer and computer hardware technician.
                </p>
                <a href="#" class="btn">Read More</a>

            </div>
            <?php
        }
       
       
        
    ?>
    
    
</section>
<!--End About Section-->

<!---Service Section-->
<section class="service" id="service">
    <h2 class="heading">My <span>Services</span></h2>
    <div class="service-container">
        <div class="service-box">
            <i class="fa-solid fa-code"></i>
            <h3>Web Development</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempora veniam,
                    numquam eius odit temporibus quam quas, veritatis cupiditate ipsum harum, quo similique.
            </p>
            <a href="#" class="btn">Read More</a>
        </div>
        <div class="service-box">
            <i class="fa-solid fa-web-awesome"></i>
            <h3>Web Designing</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempora veniam,
                    numquam eius odit temporibus quam quas, veritatis cupiditate ipsum harum, quo similique.
            </p>
            <a href="#" class="btn">Read More</a>
        </div>
        <div class="service-box">
            <i class="fa-solid fa-desktop"></i>
            <h3>Computer Hardware Engineer</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempora veniam,
                    numquam eius odit temporibus quam quas, veritatis cupiditate ipsum harum, quo similique.
            </p>
            <a href="#" class="btn">Read More</a>
        </div>
    </div>
</section>
<!---End Service Section-->

<!--Portfolio Section-->
<section class="portfolio-container" id="portfolio">
    <h2 class="heading">Portfolio</h2>
    <div class="portfolio-wrapper">
        <div class="portfolio-box mySwiper">
            <div class="portfolio-content swiper-wrapper">
                <div class="portfolio-slide swiper-slide">
                    <img src="images/img2.png" alt="img">
                    <h3>Md Kaif</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Harum fugiat sapiente pariatur? Sit beatae quis sapiente,
                        laboriosam libero facilis odit sint quasi earum, impedit 
                        quo eaque doloribus, inventore eius praesentium!
                    </p>
                </div>
                <div class="portfolio-slide swiper-slide">
                    <img src="images/about.png" alt="img">
                    <h3>Md Kaif</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Harum fugiat sapiente pariatur? Sit beatae quis sapiente,
                        laboriosam libero facilis odit sint quasi earum, impedit 
                        quo eaque doloribus, inventore eius praesentium!
                    </p>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<!--portfolio End section-->

<!--Section contact us-->
<section class="contact" id="contact">
    <h2 class="heading">Contact <span>Me!</span></h2>
    <form action="#">
        <div class="input-box">
            <input type="text" placeholder="Full Name">
            <input type="email" placeholder="Email Address">
        </div>
        <div class="input-box">
            <input type="text" placeholder="Mobile">
            <input type="text" placeholder="Subject">
        </div>
        <textarea name="" id="" cols="10" rows="5" placeholder="Your Message!"></textarea>
        <input type="text" class="btn" value="Send Message">
    </form>
</section>
<!--End section contact us-->

<?php include 'footer.php'; ?>