
<div class="container-fluid">
	<div class="row">
		<div class="col-xl-12">
			<div class="breadcrumb-holder">
				<h1 class="main-title float-left">Register School Grade</h1>
				<ol class="breadcrumb float-right">
				<li class="breadcrumb-item"><?php echo $db->getData('xsms_school','schoolName','schoolCode',$id_school);?></li>
				<li class="breadcrumb-item active">School Grades</li>
				</ol>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->
	
	<div class="row">					
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
			<div class="card mb-3">
				<div class="card-header">
					<h3><i class="fa fa-hand-pointer-o"></i> Register School Grades</h3>
				</div>
					
				<div class="card-body">
					<form method="post" action="action_student.php" autocomplete="off" data-parsley-validate novalidate>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="example2">Level</label>
									<select name="levelId[]" class="form-control select2" multiple style="width: 100%;" required>
										<option value="">Select Level ...</option>
										<?php 
											$studyLevel=$db->getRows('xsms_school_level', array('where'=>array('schoolCode'=>$id_school,'status'=>1),'order_by'=>'schoolLevelCode ASC'));
											if (!empty($studyLevel))
											{
												foreach ($studyLevel as $studyLevel)
												{
													$level=$studyLevel['educationLevelCode']; 
													?>
													<option value="<?php echo $level;?>">
														<?php echo $db->getData('xsms_educational_level','educationLevelName','educationLevelCode',$level)?>
													</option>
													<?php 
												}
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<div id="dynamic_row">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-1">
											<div class="form-group">
												<br>
												<button id="add" type="button" class="btn btn-primary">
													<span class="fa fa-plus"></span>
												</button>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="example2">Grade<span class="text-danger">*</span></label>								
												<select name="grade" id="" class="form-control">
													<option value="" readonly>Select Here ...</option>
													<option value="A">A</option>
													<option value="B+">B+</option>
													<option value="B">B</option>
													<option value="C">C</option>
													<option value="D">D</option>
													<option value="E">E</option>
													<option value="F">F</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Max Marks</label>
												<input class="form-control" placeholder="Max Marks" name="maxMarks" type="number" max="100" required/>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Min Marks<span class="text-danger">*</span></label>
												<input class="form-control" placeholder="Min Marks" name="minMarks" type="number" onChange="showValidate();" data-parsley-trigger="change" id="minID" required />
											</div>
										</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-4">
								<input name="schoolID" type="hidden" value="<?php echo $id_school;?>">
								<button class="btn btn-success form-control" name="doSave" type="submit">
									Save
								</button>
							</div>
							<div class="col-md-4">
								<a href="index3.php?sp=view_students">
									<span class="btn btn-primary form-control">Cancel</span>
								</a>
							</div>
							<div class="col-md-2"></div>
						</div>
						<br/>
					</form>
				</div>														
			</div>
			<!-- end card-->					
      	</div>
		<!-- end col -->	
	</div>
	<!-- end row -->	
</div>
<!-- END container-fluid -->
<script>
	$(document).ready(function() {
		var i = 1;
		
		$("#add").click(function() {
			i++;
			var lastMin = parseInt($("#minID").val()) - 1;
			$('#dynamic_row').append(
				'<div class="row" id="row'+i+'">'
					+'<div class="col-md-12">'
						+'<div class="row">'
							+'<div class="col-md-1">'
								+'<div class="form-group">'
									+'<button type="button" class="btn btn-danger btn_remove" id="'+i+'">'
										+'<span class="fa fa-minus"></span>'
									+'</button>'
								+'</div>'
							+'</div>'
							+'<div class="col-md-4">'
								+'<div class="form-group">'						
									+'<select name="grade[]" id="" class="form-control">'
										+'<option value="" readonly>Select Here ...</option>'
										+'<option value="A">A</option>'
										+'<option value="B+">B+</option>'
										+'<option value="B">B</option>'
										+'<option value="C">C</option>'
										+'<option value="D">D</option>'
										+'<option value="E">E</option>'
										+'<option value="F">F</option>'
									+'</select>'
								+'</div>'
							+'</div>'
							+'<div class="col-md-4">'
								+'<div class="form-group">'
									+'<input class="form-control" placeholder="Max Marks" id="maxM'+i+'" name="maxMarks[]" value="'+lastMin+'" type="number" required readonly/>'
								+'</div>'
							+'</div>'
							+'<div class="col-md-3">'
								+'<div class="form-group">'
									+'<input class="form-control" id="minID'+i+'" placeholder="Min Marks" name="minMarks[]" min="maxM'+i+'" type="number" data-parsley-trigger="change" required />'
								+'</div>'
							+'</div>'
						+'</div>'
					+'</div>'
				+'</div>'
			);
			//var minM = parseInt($("#last"+i).val()) + 1;
		});
		
		
		
		$(document).on('click','.btn_remove', function() {
			var button_id = $(this).attr("id");
			$("#row"+button_id).remove();
		});
	});
</script>

