<?php if(isset($data) && $data){?>
	<?php if(isset($data['limit'])){?>
	<div class="form-group limit">
	 	<label>Limit</label>
	 	<input type="text" class="form-control" placeholder="Enter ..." name="limit" >
	 	<span class="text-red"></span>
	 </div>
	 <?php }?>
	 <?php if(isset($data['limit_category'])){?>
		 <div class="form-group limit">
		 	<label>Limit category</label>
		 	<input type="text" class="form-control" placeholder="Enter ..." name="limit_category" >
		 	<span class="text-red"></span>
		 </div>
	 <?php }?>
	 <?php if(isset($data['category'])){?>
	 <div class="form-group result ">
	 	<label>Number id</label>
	 	<select class="form-control" name="id_category" id="item_result"> 
	 		<?php foreach($data['category'] as $cat){?>
	 			<option value="{{$cat->id}}">{{$cat->name}}</option>
	 		<?php }?>
	 	</select>
	 	<span class="text-red"></span>
	 </div>
	 <?php }?>
<?php }?>
