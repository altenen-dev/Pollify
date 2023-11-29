<!-- ========== Left Sidebar Start ========== -->

<div class="vertical-menu">



    <div data-simplebar class="h-100">



        <!--- Sidemenu -->

        <div id="sidebar-menu">

            <!-- Left Menu Start -->

            <ul class="metismenu list-unstyled" id="side-menu">

                <li class="menu-title" style="font-family: 'Almarai', sans-serif;">الخيارات</li>



                <li>

                    <a href="dashboard" class="waves-effect">

                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                        <span style="font-family: 'Almarai', sans-serif;">الرئيسية</span>

                    </a>

                </li>


                <?php

                $SQL2 = $odb->prepare("SELECT * FROM `usersapps` WHERE `username` = :uname ");

                $SQL2->execute(array(':uname' => $_SESSION['username']));



                $AppCount = $SQL2->fetchColumn(0);







                 ?>



     <?php if ($AppCount > 0){ ?>

                <li>

                    <a href="myapps" class="waves-effect">

                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-bag"></i></div>

                        <span style="font-family: 'Almarai', sans-serif;">تطبيقاتي</span>

                    </a>

                </li>



     <?php } ?>

  <li style="font-family: 'Almarai', sans-serif;" class="menu-title">شخصي</li>

                 <?php if ($AppCount > 0){ ?>

                   <li>

                       <a href="myips" class="waves-effect">

                           <div class="d-inline-block icons-sm mr-1"><i class="uim uim-anchor"></i></div>

                           <span style="font-family: 'Almarai', sans-serif;">ايبياتي</span>

                       </a>

                   </li>

                 <?php } ?>







                <li>

                    <a href="profile" class="waves-effect">

                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-at"></i></div>

                        <span style="font-family: 'Almarai', sans-serif;">حسابي</span>

                    </a>

                </li>

                <li>

                    <a href="https://discord.gg/hENVcGW" class="waves-effect">

                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-exclamation-circle"></i></div>

                        <span style="font-family: 'Almarai', sans-serif;">مساعدة</span>

                    </a>

                </li>

                <li>

                    <a href="logout" class="waves-effect">

                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-multiply"></i></div>

                        <span style="font-family: 'Almarai', sans-serif;">تسجيل خروج</span>

                    </a>

                </li>

                	<?php if ($user -> isAdmin($odb)){ ?>

                      <li style="font-family: 'Almarai', sans-serif;" class="menu-title">اداري</li>

                      <li>

                          <a href="admin/index" class="waves-effect">

                              <div class="d-inline-block icons-sm mr-1"><i class="uim uim-star-half-alt"></i></div>

                              <span style="font-family: 'Almarai', sans-serif;">لوحة التحكم</span>

                          </a>

                      </li>

				<?php } ?>



        <?php if ($user -> isMoz3($odb)){ ?>

            <li style="font-family: 'Almarai', sans-serif;" class="menu-title">موزع</li>

            <li>

                <a href="moz3codes" class="waves-effect">

                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-star-half-alt"></i></div>

                    <span style="font-family: 'Almarai', sans-serif;">المفاتيح</span>

                </a>

            </li>

            <li>

                <a href="moz3apps" class="waves-effect">

                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-star-half-alt"></i></div>

                    <span style="font-family: 'Almarai', sans-serif;">البرامج</span>

                </a>

            </li>

<?php } ?>



<li style="font-family: 'Almarai', sans-serif;" class="menu-title">المدراء</li>



<?php

$findAdmins = $odb->query("SELECT * FROM `users` WHERE `rank` = '1'");

while($rowAdmins = $findAdmins->fetch(PDO::FETCH_BOTH)){



$logo = "uim uim-star";



echo '



<li><a href="#" class="waves-effect">

    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-star-half-alt"></i></div>

    <span >'. $rowAdmins['username'] .'</span>

</a></li>';

}

?>

<li style="font-family: 'Almarai', sans-serif;" class="menu-title">الموزعين</li>



<?php

$findmoz3 = $odb->query("SELECT * FROM `users` WHERE `rank` = '2'");

while($rowmoz3 = $findmoz3->fetch(PDO::FETCH_BOTH)){







echo '



<li><a href="#" class="waves-effect">

    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-analysis"></i></div>

    <span >'. $rowmoz3['username'] .'</span>

</a></li>';

}

?>



                    </ul>

                </li>



            </ul>



        </div>

        <!-- Sidebar -->

    </div>

</div>

<!-- Left Sidebar End -->

