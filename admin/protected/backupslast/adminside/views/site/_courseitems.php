<div class="script-section col-xs-12 col-lg-12 col-sm-12">

    <ul class="nav nav-tabs script-tab text-center">
        <li class="active"><a data-toggle="tab" href="#home" aria-expanded="true">Active (4)</a></li>
        <li class="blue-clr"><a data-toggle="tab" href="#menu1" aria-expanded="false">Inactive (0)</a></li>
    </ul>
    <div class="tab-content">
        <div id="home" class="tab-pane fade active in">
            <div class="bs-example">
                <div class="panel-group" id="accordion">
                    <div class="panel">
                        <div class="script-text" id="row_1">
                            <h1><a href="/splat/admin/site/courseItems?i=MQ%3D%3D&amp;f=MQ%3D%3D&amp;c=MQ%3D%3D" class="item_link">1.
                                    MA (Hons) ScriptWriting</a>

                                <span class="pull-right">
                                                                                                    <i class="fa fa-trash" onclick="ConfirmDelete('1')"></i>
                                                                                                <i class="fa fa-cog" data-toggle="modal" data-target="#courseModal_1"></i>
								  </span>
                            </h1>
                            <p><span>Users:
                                                18                                            </span></p>
                        </div>
                        <div class="modal fade" id="courseModal_1" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
                                    <div class="modal-header col-lg-12">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title text-center">Courses</h4>
                                    </div>
                                    <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                                        <form id="course-form1" action="/splat/admin/site/courses?i=MQ%3D%3D&amp;f=MQ%3D%3D" method="post">                                                    <input name="Courses[id]" id="Courses_id" type="hidden" value="1">                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_name" class="required">Course Name <span class="required">*</span></label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <input placeholder="Name" name="Courses[name]" id="Courses_name" type="text" maxlength="255" value="ScriptWriting">                                                            <div class="errorMessage" id="Courses_name_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_type">Level</label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <select name="Courses[type]" id="Courses_type">
                                                        <option value="">Select Type</option>
                                                        <option value="1" selected="selected">MA (Hons)</option>
                                                        <option value="2">BA (Hons)</option>
                                                        <option value="6">AWA</option>
                                                        <option value="7">kjlkj</option>
                                                        <option value="8">jhuh</option>
                                                        <option value="9">mkj</option>
                                                    </select>                                                            <div class="errorMessage" id="Courses_type_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_year" class="required">Start Year <span class="required">*</span></label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <input placeholder="year" maxlength="4" class="datepicker hasDatepicker" id="Courses_year_1" name="Courses[year]" type="text" value="02/28/2018">                                                            <div class="errorMessage" id="Courses_year_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_description">Description</label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <textarea placeholder="Description" name="Courses[description]" id="Courses_description">MA ScriptWriting</textarea>                                                            <div class="errorMessage" id="Courses_description_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_status">Status</label>                                                        </div>
                                                <div class="col-lg-8 padzero formradio">
                                                    <input id="ytCourses_status" type="hidden" value="" name="Courses[status]"><span id="Courses_status"><input id="Courses_status_0" value="active" checked="checked" type="radio" name="Courses[status]"> <label style="display:inline" for="Courses_status_0">Active</label>  <input id="Courses_status_1" value="inactive" type="radio" name="Courses[status]"> <label style="display:inline" for="Courses_status_1">Inactive</label></span>                                                            <div class="errorMessage" id="Courses_status_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <input class="save-btn" type="submit" name="yt0" value="Save">                                                    </form>                                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="script-text" id="row_2">
                            <h1><a href="/splat/admin/site/courseItems?i=MQ%3D%3D&amp;f=MQ%3D%3D&amp;c=Mg%3D%3D" class="item_link">2.
                                    BA (Hons) Cinematography</a>

                                <span class="pull-right">
                                                                                                    <i class="fa fa-trash" onclick="ConfirmDelete('2')"></i>
                                                                                                <i class="fa fa-cog" data-toggle="modal" data-target="#courseModal_2"></i>
								  </span>
                            </h1>
                            <p><span>Users:
                                                10                                            </span></p>
                        </div>
                        <div class="modal fade" id="courseModal_2" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
                                    <div class="modal-header col-lg-12">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title text-center">Courses</h4>
                                    </div>
                                    <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                                        <form id="course-form2" action="/splat/admin/site/courses?i=MQ%3D%3D&amp;f=MQ%3D%3D" method="post">                                                    <input name="Courses[id]" id="Courses_id" type="hidden" value="2">                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_name" class="required">Course Name <span class="required">*</span></label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <input placeholder="Name" name="Courses[name]" id="Courses_name" type="text" maxlength="255" value="Cinematography">                                                            <div class="errorMessage" id="Courses_name_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_type">Level</label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <select name="Courses[type]" id="Courses_type">
                                                        <option value="">Select Type</option>
                                                        <option value="1">MA (Hons)</option>
                                                        <option value="2" selected="selected">BA (Hons)</option>
                                                        <option value="6">AWA</option>
                                                        <option value="7">kjlkj</option>
                                                        <option value="8">jhuh</option>
                                                        <option value="9">mkj</option>
                                                    </select>                                                            <div class="errorMessage" id="Courses_type_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_year" class="required">Start Year <span class="required">*</span></label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <input placeholder="year" maxlength="4" class="datepicker hasDatepicker" id="Courses_year_2" name="Courses[year]" type="text" value="02/01/2018">                                                            <div class="errorMessage" id="Courses_year_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_description">Description</label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <textarea placeholder="Description" name="Courses[description]" id="Courses_description">MA Cinematography</textarea>                                                            <div class="errorMessage" id="Courses_description_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_status">Status</label>                                                        </div>
                                                <div class="col-lg-8 padzero formradio">
                                                    <input id="ytCourses_status" type="hidden" value="" name="Courses[status]"><span id="Courses_status"><input id="Courses_status_0" value="active" checked="checked" type="radio" name="Courses[status]"> <label style="display:inline" for="Courses_status_0">Active</label>  <input id="Courses_status_1" value="inactive" type="radio" name="Courses[status]"> <label style="display:inline" for="Courses_status_1">Inactive</label></span>                                                            <div class="errorMessage" id="Courses_status_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <input class="save-btn" type="submit" name="yt1" value="Save">                                                    </form>                                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="script-text" id="row_14">
                            <h1><a href="/splat/admin/site/courseItems?i=MQ%3D%3D&amp;f=MQ%3D%3D&amp;c=MTQ%3D" class="item_link">3.
                                    AWA Testcourse</a>

                                <span class="pull-right">
                                                                                                    <i class="fa fa-trash" onclick="ConfirmDelete('14')"></i>
                                                                                                <i class="fa fa-cog" data-toggle="modal" data-target="#courseModal_14"></i>
								  </span>
                            </h1>
                            <p><span>Users:
                                                0                                            </span></p>
                        </div>
                        <div class="modal fade" id="courseModal_14" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
                                    <div class="modal-header col-lg-12">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title text-center">Courses</h4>
                                    </div>
                                    <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                                        <form id="course-form14" action="/splat/admin/site/courses?i=MQ%3D%3D&amp;f=MQ%3D%3D" method="post">                                                    <input name="Courses[id]" id="Courses_id" type="hidden" value="14">                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_name" class="required">Course Name <span class="required">*</span></label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <input placeholder="Name" name="Courses[name]" id="Courses_name" type="text" maxlength="255" value="testcourse">                                                            <div class="errorMessage" id="Courses_name_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_type">Level</label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <select name="Courses[type]" id="Courses_type">
                                                        <option value="">Select Type</option>
                                                        <option value="1">MA (Hons)</option>
                                                        <option value="2">BA (Hons)</option>
                                                        <option value="6" selected="selected">AWA</option>
                                                        <option value="7">kjlkj</option>
                                                        <option value="8">jhuh</option>
                                                        <option value="9">mkj</option>
                                                    </select>                                                            <div class="errorMessage" id="Courses_type_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_year" class="required">Start Year <span class="required">*</span></label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <input placeholder="year" maxlength="4" class="datepicker hasDatepicker" id="Courses_year_14" name="Courses[year]" type="text" value="06/30/2018">                                                            <div class="errorMessage" id="Courses_year_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_description">Description</label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <textarea placeholder="Description" name="Courses[description]" id="Courses_description"></textarea>                                                            <div class="errorMessage" id="Courses_description_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_status">Status</label>                                                        </div>
                                                <div class="col-lg-8 padzero formradio">
                                                    <input id="ytCourses_status" type="hidden" value="" name="Courses[status]"><span id="Courses_status"><input id="Courses_status_0" value="active" checked="checked" type="radio" name="Courses[status]"> <label style="display:inline" for="Courses_status_0">Active</label>  <input id="Courses_status_1" value="inactive" type="radio" name="Courses[status]"> <label style="display:inline" for="Courses_status_1">Inactive</label></span>                                                            <div class="errorMessage" id="Courses_status_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <input class="save-btn" type="submit" name="yt2" value="Save">                                                    </form>                                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="script-text" id="row_15">
                            <h1><a href="/splat/admin/site/courseItems?i=MQ%3D%3D&amp;f=MQ%3D%3D&amp;c=MTU%3D" class="item_link">4.
                                    Fdghdfd</a>

                                <span class="pull-right">
                                                                                                    <i class="fa fa-trash" onclick="ConfirmDelete('15')"></i>
                                                                                                <i class="fa fa-cog" data-toggle="modal" data-target="#courseModal_15"></i>
								  </span>
                            </h1>
                            <p><span>Users:
                                                0                                            </span></p>
                        </div>
                        <div class="modal fade" id="courseModal_15" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content col-xs-12 col-lg-12 col-sm-12">
                                    <div class="modal-header col-lg-12">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title text-center">Courses</h4>
                                    </div>
                                    <div class="model-form col-lg-12 col-xs-12 col-sm-12 form">
                                        <form id="course-form15" action="/splat/admin/site/courses?i=MQ%3D%3D&amp;f=MQ%3D%3D" method="post">                                                    <input name="Courses[id]" id="Courses_id" type="hidden" value="15">                                                    <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_name" class="required">Course Name <span class="required">*</span></label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <input placeholder="Name" name="Courses[name]" id="Courses_name" type="text" maxlength="255" value="fdghdfd">                                                            <div class="errorMessage" id="Courses_name_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_type">Level</label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <select name="Courses[type]" id="Courses_type">
                                                        <option value="">Select Type</option>
                                                        <option value="1">MA (Hons)</option>
                                                        <option value="2">BA (Hons)</option>
                                                        <option value="6">AWA</option>
                                                        <option value="7">kjlkj</option>
                                                        <option value="8">jhuh</option>
                                                        <option value="9">mkj</option>
                                                    </select>                                                            <div class="errorMessage" id="Courses_type_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_year" class="required">Start Year <span class="required">*</span></label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <input placeholder="year" maxlength="4" class="datepicker hasDatepicker" id="Courses_year_15" name="Courses[year]" type="text" value="06/2">                                                            <div class="errorMessage" id="Courses_year_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_description">Description</label>                                                        </div>
                                                <div class="col-lg-8 padzero">
                                                    <textarea placeholder="Description" name="Courses[description]" id="Courses_description"></textarea>                                                            <div class="errorMessage" id="Courses_description_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <div class="col-xs-12 col-lg-12 col-sm-12 course-field padzero">
                                                <div class="col-lg-4 padzero">
                                                    <label for="Courses_status">Status</label>                                                        </div>
                                                <div class="col-lg-8 padzero formradio">
                                                    <input id="ytCourses_status" type="hidden" value="" name="Courses[status]"><span id="Courses_status"><input id="Courses_status_0" value="active" checked="checked" type="radio" name="Courses[status]"> <label style="display:inline" for="Courses_status_0">Active</label>  <input id="Courses_status_1" value="inactive" type="radio" name="Courses[status]"> <label style="display:inline" for="Courses_status_1">Inactive</label></span>                                                            <div class="errorMessage" id="Courses_status_em_" style="display:none"></div>                                                        </div>
                                            </div>
                                            <input class="save-btn" type="submit" name="yt3" value="Save">                                                    </form>                                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu1" class="tab-pane fade">
            <div class="bs-example">
                <div class="panel-group" id="accordion">
                    <div class="panel">

                        <div class="script-text">
                            <h1>No inactive courses found.</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="button" value="Add a Course" class="add-course" data-toggle="modal" data-target="#courseModal">
</div>