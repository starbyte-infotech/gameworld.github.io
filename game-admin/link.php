<?php 

include('header.php');
include('config.php');

$get_subadmin = "SELECT * FROM `tbl_subadmin`";
$res_subadmin = mysqli_query($conn, $get_subadmin);
 ?>
            <div class="content">
                <div class="row">
                <?php while($fetch_subadmin = mysqli_fetch_array($res_subadmin)){ 

                  $sub_id = $fetch_subadmin['id'];
                  $get_links = "SELECT * FROM `tbl_generate_link` WHERE `sub_admin` = '$sub_id' AND `status` = 0"; 
                  $res_links = mysqli_query($conn, $get_links);
                  $num_rows = mysqli_num_rows($res_links); 

                ?>
                    <div class="col-lg-4">
                        <a href="link-veriification.php?sub_id=<?php echo $sub_id ?>">
                            <div class="card card-chart">
                                <div class="card-header">
                                    <h5 class="card-category"><?php echo $num_rows ?> Link Request</h5>
                                    <h4 class="card-title" style="color: #2c2c2c;"><?php echo $fetch_subadmin['first_name'].' '.$fetch_subadmin['last_name'] ?></h4>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="now-ui-icons ui-2_time-alarm"></i> 1 minute ago
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                  <?php } ?>
                   <!--  <div class="col-lg-4 col-md-6">
                        <a href="link-veriification.html">
                            <div class="card card-chart">
                                <div class="card-header">
                                    <h5 class="card-category">2 Link Request</h5>
                                    <h4 class="card-title" style="color: #2c2c2c;">Dabba</h4>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="now-ui-icons ui-2_time-alarm"></i> 2 hours ago
                                    </div>
                                </div>
                            </div>
                        </a>
                          </div>
                          <div class="col-lg-4 col-md-6">
                              <a href="link-veriification.html">
                                  <div class="card card-chart">
                                      <div class="card-header">
                                          <h5 class="card-category">5 Link Request</h5>
                                          <h4 class="card-title" style="color: #2c2c2c;">Jabba</h4>
                                      </div>
                                      <div class="card-footer">
                                          <div class="stats">
                                              <i class="now-ui-icons ui-2_time-alarm"></i> 1 days ago
                                          </div>
                                      </div>
                                  </div>
                              </a>
                          </div>

                          <div class="col-lg-4 col-md-6">
                              <a href="link-veriification.html">
                                  <div class="card card-chart">
                                      <div class="card-header">
                                          <h5 class="card-category">4 Link Request</h5>
                                          <h4 class="card-title" style="color: #2c2c2c;">User</h4>
                                      </div>

                                      <div class="card-footer">
                                          <div class="stats">
                                              <i class="now-ui-icons ui-2_time-alarm"></i> 5 days ago
                                          </div>
                                      </div>
                                  </div>
                              </a>
                          </div> -->
                          <!-- <div class="col-lg-4 col-md-6">
                  <a href="action-table.html">
                    <div class="card card-chart">
                      <div class="card-header">
                        <h5 class="card-category">147 Games</h5>
                        <h4 class="card-title" style="color: #2c2c2c;">Stratergy</h4>
                      </div>

                      <div class="card-footer">
                        <div class="stats">
                          <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
                        </div>
                      </div>
                    </div>
                  </a>
                </div> -->
                </div>
            </div>
<?php include('footer.php'); ?>