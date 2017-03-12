<?php 
    if(empty($inp_email))
        $inp_email = '';
    if(empty($inp_password))
        $inp_password = '';

    function putMenuItem($NaviEnum) {
        $current = (Application::$section == $NaviEnum)? ' class="active" ' : ' ';
        echo '<li id="grad_1"><a href="'.Navi::GetUrl($NaviEnum).'" '.$current.'>'.$NaviEnum.'</a></li>';
    }

    function putMenuStudent() {
        putMenuItem(Navi::Dashboard);
        putMenuItem(Navi::Program);
        putMenuItem(Navi::Enrollment);
        putMenuItem(Navi::Profile);
    }

    function putMenuStaff() {
        putMenuItem(Navi::Dashboard);
        putMenuItem(Navi::Program);
        putMenuItem(Navi::Subject);
        putMenuItem(Navi::Member);
        putMenuItem(Navi::Student);
        putMenuItem(Navi::Professor);
        putMenuItem(Navi::Enrollment);
        putMenuItem(Navi::Profile);
    }

    function putMenuProfessor() {
        putMenuItem(Navi::Dashboard);
        putMenuItem(Navi::Program);
        putMenuItem(Navi::Member);
        putMenuItem(Navi::Student);
        putMenuItem(Navi::Professor);
        putMenuItem(Navi::Profile);
    }

    function DisplayMainNenu() {
        switch(SessionManager::GetUserTypeCode()) {
            case 100:
                putMenuStudent();
                break;
            case 200:
                putMenuStaff();
                break;
            case 300:
                putMenuProfessor();
                break;
        }
    }
?>
<header>
        <div class="head">
        

	<nav>
    <div class="head_right" style="padding: 6px 11px;">
      <?php if(SessionManager::IsLoggedIn() ) { ?>

          <a href="<?=Navi::GetUrl(Navi::Profile);?>" ><?=SessionManager::GetUserName();?>&nbsp;(&nbsp;<?=SessionManager::GetUserTypeName();?>&nbsp;)</a> &nbsp; | &nbsp;
          <a href="<?=Navi::GetUrl(Navi::Login,'logout');?>" >Logout</a>
      <?php }  else { ?>
          <a href="<?=Navi::GetUrl(Navi::Login,'logout');?>" >login</a>  &nbsp; | &nbsp;
          <a href="<?=Navi::GetUrl(Navi::Join);?>" >Register</a>
      
      <?php } ?>
    </div>
    
    <ul class="nav_main">
        <li id="title"><a href="<?php echo (SessionManager::IsLoggedIn())? Navi::GetUrl(Navi::Dashboard) : URL;?>" ><?=APP_NAME?></a></li>
    <?php if(SessionManager::IsLoggedIn() ) {
            DisplayMainNenu(); 
        } ?>
    </ul>

	</nav>        
        </div>


</header>