if ($_FILES['profile']['name'] != "") {
                        $img = $_FILES['profile'];
                        $path_parts = pathinfo($img['name']);
                        $imageName = time() . "." . $path_parts['extension'];
                        $config['upload_path'] = $updateImagePath;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config["file_name"] = $imageName;
                        $this->load->library('upload', $config);
                        if (!empty($checkuser->vImage) && file_exists($updateImagePath . $checkuser->vImage)) {
                            unlink($updateImagePath . $checkuser->vImage);
                        }
                        $finalimage = $this->upload->do_upload('profile');
                        }
                        
                        
                        
                        <div class="col-lg-4 left-area-profile">
                                            <div class="profile-bg-area">
                                                <img id="profilePic" src="<?php echo base_url() ?>assets/images/common.png" class="img-responsive" alt=""> 
                                            </div> 
                                            <input type="hidden" name="profileForm" />
                                            <input type="hidden" id="image" name="image" />
                                            <div class="left-area-btn-area cstm-left-area-btn">
                                                <button class="au-btn au-btn--block au-btn--green m-b-20 left-area-btn detail-btn" type="button" onclick="performClick('theImage');">Browse 
                                                    <span class="uil-camera-plus camera-plus-unicons cstm-plus-icons"></span>
                                                    <!--<input type="file" name="pic" accept="image/*" class="pic-input" required>-->
                                                </button>
                                            </div>
                                            <input type="file" id="theImage" name="profile"  onchange="return checkExtansion();" style="display:none"  required/>
                                            <label id="theImage-error" class="error" for="theImage"></label>
                                            <label id="image-error" class="error" for="image"></label>
                                        </div>
                                        
                                        
                                        function performClick(elemId) {

        $("#flashError").html('');
        $("#flashSuccess").html('');
        var elem = document.getElementById(elemId);
        if (elem && document.createEvent) {
            var evt = document.createEvent("MouseEvents");
            evt.initEvent("click", true, false);
            elem.dispatchEvent(evt);
        }
        $('#theImage').change(function (event) {
            $("#profilePic").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
//            $("#image").val(URL.createObjectURL(event.target.files[0]));
        });
    }
    function checkExtansion() {
        var fileExtension = ['jpeg', 'jpg', 'png'];
        if ($.inArray($("#theImage").val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : " + fileExtension.join(', '));
            $("#theImage").val('');
            return false;
        }
    }
    
    $path = './uploads/';
                    $updateImagePath = './uploads/users/';
                    $storagePath = 'uploads/users/';
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                        chmod($path, 0777);
                    }
                    if (!file_exists($updateImagePath)) {
                        mkdir($updateImagePath, 0777, true);
                        chmod($updateImagePath, 0777);
                    }
