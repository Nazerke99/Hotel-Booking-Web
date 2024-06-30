<?php
require ('inc/essen.php');
require ('inc/db_config.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities and Features</title>
    <?php require ('inc/links.php'); ?>
    <style>
        #dashboard-menu {
            position: fixed;
            height: 100%;
        }

        #main-content {
            margin-top: 60px;
        }
    </style>
</head>

<body class="bg-light">
    <?php require ('inc/header.php'); ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Features and Facilities
                </h3>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card_title m-0 ">Features</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#feature-s">
                                <i class="bi-bi-plus-square"></i>ADD
                            </button>
                        </div>
                        <div class="table-responsive-md" style="height:350px;  overflow-y: auto;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="feature-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card_title m-0 ">Facilities</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#facilities-s">
                                <i class="bi-bi-plus-square"></i>ADD
                            </button>
                        </div>
                        <div class="table-responsive-md" style="height:350px;  overflow-y: auto;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" width="40%">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="facilities-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--Features modal-->
                <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="feature_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Feature</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" name="feature_name" class="form-control shadow-none"
                                            required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn text-secondary shadow-none"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!--Facilities modal-->
                <div class="modal fade" id="facilities-s" data-bs-backdrop="static" data-bs-keyboard="true"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="facility_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Facility</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" name="facility_name" class="form-control shadow-none"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Icon</label>
                                        <input type="file" name="facility_icon" accept=".svg"
                                            class="form-control shadow-none">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Description</label>
                                        <textarea name="facility_desc" class="form-control shadow-none"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn text-secondary shadow-none"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>



                <script>
                    let feature_s_form = document.getElementById('feature_s_form');
                    let facility_s_form = document.getElementById('facility_s_form');
                    feature_s_form.addEventListener('submit', function (e) {
                        e.preventDefault();
                        add_feature();
                    });

                    function add_feature() {
                        let data = new FormData();
                        data.append('name', feature_s_form.elements['feature_name'].value);
                        data.append('add_feature', '');

                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/features_facilities.php", true);
                        xhr.onload = function () {
                            console.log(this.responseText); // Debugging statement
                            var myModal = document.getElementById('feature-s');
                            var modal = bootstrap.Modal.getInstance(myModal);
                            modal.hide();
                            if (this.responseText == 1) {
                                alert('Feature is added!');
                                feature_s_form.reset();
                                get_features();
                            }
                        }
                        xhr.send(data);
                    }

                    function get_features() {
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/features_facilities.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onload = function () {
                            if (xhr.status === 200) {
                                document.getElementById('feature-data').innerHTML = xhr.responseText;
                            } else {
                                console.error("Request failed with status:", xhr.status);
                            }
                        };
                        xhr.send('get_features'); // Ensure to send the correct payload
                    }

                    function rem_feature(val) {
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/features_facilities.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onload = function () {
                            if (this.responseText == 1) {
                                window.alert('Feature is removed');
                                get_features();
                            }
                            else if (this.responseText == 'rooms_added') {
                                window.alert('error', 'Feature is added in room');
                            }
                            else {
                                window.alert('Changes not saved');
                            }
                        };
                        xhr.send('rem_feature=' + val);
                    }

                    facility_s_form.addEventListener('submit', function (e) {
                        e.preventDefault();
                        add_facility();
                    });
                    function add_facility() {
                        let data = new FormData();
                        data.append('name', facility_s_form.elements['facility_name'].value);
                        data.append('icon', facility_s_form.elements['facility_icon'].files[0]);
                        data.append('desc', facility_s_form.elements['facility_desc'].value);
                        data.append('add_facility', '');

                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/features_facilities.php", true);
                        xhr.onload = function () {
                            var myModal = document.getElementById('facilities-s');
                            var modal = bootstrap.Modal.getInstance(myModal);
                            modal.hide();
                            if (this.responseText == 'inv_img') {
                                alert('error', 'Only SVG images are allowed');
                            }
                            else if (this.responseText == 'inv_size') {
                                alert('error', 'Image must be less than 1mb');
                            }
                            else if (this.responseText == 'upd_failed') {
                                alert('error', 'Error');
                            }
                            else {
                                alert('Facility is added!');
                                facility_s_form.reset();
                                get_facilities();



                            }

                        }
                        xhr.send(data);
                    }
                    function get_facilities() {
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/features_facilities.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onload = function () {
                            if (xhr.status === 200) {
                                document.getElementById('facilities-data').innerHTML = xhr.responseText;
                            } else {
                                console.error("Request failed with status:", xhr.status);
                            }
                        };
                        xhr.send('get_facilities'); // Ensure to send the correct payload
                    }
                    function rem_facility(val) {
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "ajax/features_facilities.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onload = function () {
                            if (this.responseText == 1) {
                                window.alert('Facility is removed');
                                get_facilities();
                            } else {
                                window.alert('Changes not saved');
                            }
                        };
                        xhr.send('rem_facility=' + val);
                    }
                    window.onload = function () {
                        get_features();
                        get_facilities();

                    };

                </script>





                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>