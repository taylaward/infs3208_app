
<div class="row">
    <div class="col">
        <h2>
            Posts
        </h2>
        <div class="row p-3 jumbotron">
            <div class="col">
            
                <h6 class="text-left">
                    Categories
                <span <?php if ($profile['status'] == 0) {echo "hidden";}?>>
                <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addCat">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                </svg>
                </button>
                </span>
                </h6>
                <select name="category" id="category" class="form-control input-lg">
                    <option value="">Select All</option>
                    <?php
                        foreach($categories as $row){
                            echo '<option value="'.$row["category_id"].'">'.$row["name"].'</option>';
                        }
                    ?>
                </select>
                <!-- <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                        Select Category
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item disabled" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div> --><br>
                <h6>
                    Sort By
                </h6>
                <div class="dropdown">
                        
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item disabled" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4 d-flex">
                <div class="align-self-end ml-auto">
                    <button type="button" class="btn btn-primary float-right align-bottom">
                        Create Post
                    </button>
                </div>
            </div>
        </div>
        <div class="card bg-default">
            <h5 class="card-header">
                Card title
            </h5>
            <div class="card-body">
                <p class="card-text">
                    Card content
                </p>
            </div>
            <div class="card-footer">
                Card footer
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addCat" tabindex="-1" role="dialog" aria-labelledby="addCat" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo form_open(base_url().'home/addCat'); ?>
      <h5>Category Name</h5>
      <input name='category_name'>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

