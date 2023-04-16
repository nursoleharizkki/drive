            <div class="content-wrapper">
                <section class="content-header">
                    <h1 class="fontPoppins">
                        <?php echo strtoupper($title); ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
                        <?php
                        if ($this->uri->segment(3)) {
                            echo '<li class="active"><a href="' . site_url('admin/' . $this->uri->segment(2)) . '">' . strtoupper($title) . '</a></li>';
                            echo '<li class="active">' . strtoupper($this->uri->segment(3)) . '</li>';
                        } else {
                            echo '<li class="active">' . strtoupper($title) . '</li>';
                        }
                        ?>

                    </ol>
                </section>

                <section class="content">
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="box-tools pull-left">
                                <div class="form-inline">

                                </div>
                            </div>
                            <div class="box-tools pull-right">
                                <div style="padding-top:10px">
                                    <a href="<?php echo site_url('admin/pegawai') ?>" class="btn btn-success btn-flat" title="Refresh halaman">
                                        < Kembali</a>
                                            <!-- <button type="submit" class="btn btn-primary btn-flat" title="Tambah data" data-toggle="modal" data-target="#modalCreate"> Tambah</button> -->
                                </div>

                                <!-- Modal-->
                                <div class="modal fade" id="modalCreate" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Baru</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <?php echo form_open_multipart("admin/gallery/create") ?>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for=""><b style="color: black">Nama File</b></label>
                                                    <?php echo csrf(); ?>
                                                    <input type="text" class="form-control" placeholder="Nama File" name="employee_name" required="required">
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label for=""><b style="color: black">Gambar <span style="color:red">*</span></b></label>
                                                    <input type="file" class="form-control" placeholder="" name="gallery_file" required="required">
                                                </div> -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
                                                <?php echo form_close(); ?>
                                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="box-body">
                            <?php
                            if ($this->session->flashdata('alert')) {
                                echo $this->session->flashdata('alert');
                                unset($_SESSION['alert']);
                            }
                            ?>
                            <div class="table-responsive">
                                <table class="mytable table table-bordered " width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background-color: gray;color:white">
                                            <th style="width: 60px">No</th>
                                            <!-- <th style="width: 12%">#aksi</th> -->
                                            <th>Nama File</th>
                                            <th>Nama Pegawai</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($gallery) {
                                            $nox = 1;
                                            $no = 1;
                                            foreach ($gallery as $key) {

                                        ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <!-- <td>
                                                        <button class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#modalUpdate<?php echo $key->gallery_id; ?>">Update</button>
                                                        <button class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#modalDelete<?php echo $key->gallery_id ?>">Hapus</button>
                                                    </td> -->
                                                    <td>
                                                        <?php echo $key->gallery_name; ?>
                                                    </td>
                                                    <td><?php echo $key->employee_name; ?></td>
                                                    <td>
                                                        <a href="https://upbuhaluoleo.test-web.my.id/upload/gallery/<?php echo $key->gallery_file ?>" target="_blank" rel="noopener noreferrer">
                                                            <?php echo $key->gallery_file; ?>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- Modal Update-->
                                                <div class="modal fade" id="modalUpdate<?php echo $key->gallery_id ?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                                </button>
                                                            </div>
                                                            <?php echo form_open_multipart("admin/gallery/update") ?>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for=""><b style="color: black">Nama gallery </b></label>
                                                                    <?php echo csrf(); ?>
                                                                    <input type="hidden" class="form-control" placeholder="Nama gallery" name="gallery_id" value="<?php echo $key->gallery_id; ?>" required="required">
                                                                    <input type="text" class="form-control" placeholder="Nama gallery" name="employee_name" value="<?php echo $key->employee_name; ?>" required="required">
                                                                </div>

                                                                <div class="form-group">
                                                                    <a href="<?php echo base_url('upload/gallery/' . $key->gallery_file); ?>" target="_blank" rel="noopener noreferrer">Foto Sebelumnya <?= $key->gallery_file ?></a>
                                                                    <br> <label for=""><b style="color: black">Gambar</b></label>
                                                                    <input type="file" class="form-control" placeholder="" name="gallery_file">
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-warning font-weight-bold">Update</button>
                                                                <?php echo form_close(); ?>
                                                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Delete-->
                                                <div class="modal fade" id="modalDelete<?php echo $key->gallery_id ?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                                </button>
                                                            </div>
                                                            <?php echo form_open("admin/gallery/delete") ?>
                                                            <div class="modal-body">
                                                                Apakah anda yakin akan menghapus data gallery : <?php echo $key->employee_name; ?> ?
                                                                <?php echo csrf(); ?>
                                                                <input type="hidden" class="form-control" placeholder="Nama" name="employee_name" required="required" value="<?php echo $key->employee_name; ?>">
                                                                <input type="hidden" class="form-control" name="gallery_id" required="required" value="<?php echo $key->gallery_id; ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger font-weight-bold">Hapus</button>
                                                                <?php echo form_close(); ?>
                                                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                        <?php
                                                $no++;
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            <small>Page rendered in <strong>{elapsed_time}</strong> seconds.</small>
                        </div>
                    </div>
                </section>
            </div>

            <?php
            $orderStatus = 'pending';
            $orderId = 1;
            ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script type="text/javascript">
                var predefined_val = '<?php echo !empty($gallery) ? $gallery[0]->gallery_date : 0; ?>'; // your predefined value.
                var predefined_val_2 = '<?php echo !empty($gallery) ? count($gallery) : 0; ?>'; // your predefined value.
                $(document).ready(function() {
                    setInterval(function() {
                        // $.ajax({
                        //     type: "POST",
                        //     url: "autorefresh.php", //put relative url here, script which will return php

                        //     dataType: "json",
                        //     success: function(response) {
                        //         var data = response; // response data from your php script
                        //         if (predefined_val !== data.orderStatus) {
                        //             window.location.href = window.location.href;
                        //         }
                        //     }
                        // });
                        $.ajax({
                            type: "GET",
                            url: "<?php echo "https://upbuhaluoleo.test-web.my.id/api/get_gallery_pegawai?nip=" . $this->uri->segment(4); ?>",
                            success: function(msg) {
                                var data = msg; // response data from your php script
                                // console.log(data.length);
                                // console.log(predefined_val_2);
                                if (predefined_val !== data[0].gallery_date || predefined_val_2 != data.length) {
                                    // window.location.href = window.location.href;
                                    location.reload();
                                }

                            }
                        });
                    }, 5000); // function will run every 5 seconds
                });
            </script>