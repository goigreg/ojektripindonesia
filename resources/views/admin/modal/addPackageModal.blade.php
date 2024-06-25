<div class="modal fade" id="addPackage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('addNewPackage')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="package_d" class="col-sm-3 col-form-label">Package Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control-plaintext" id="package_d" name="packageCode" value="{{$package_code}}" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="package_name" class="col-sm-3 col-form-label">Package Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="package_name" name="packageName" placeholder="Name of the package" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="category" class="col-sm-3 col-form-label">Package Category</label>
                        <div class="col-sm-9">
                            <select type="text" class="form-control" id="category" name="category" required>
                                <option value="1">Day Tour</option>
                                <option value="2">Fun Activity</option>
                                <option value="3">Package</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="price" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="price" name="price" placeholder="Price of the package" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="chd_price" class="col-sm-3 col-form-label">Child Price</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="chd_price" name="chdPrice" placeholder="Price for children" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="people_min" class="col-sm-3 col-form-label">People Minimum</label>
                        <div class="col-sm-9">
                            <select type="text" class="form-control" id="people_min" name="peopleMin" required>
                                <option value="1">None</option>
                                <option value="2">2 People</option>
                                <option value="3">3 People</option>
                                <option value="4">4 People</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="" class="col-sm-3 col-form-label">Package Photo</label>
                        <div class="row col-sm-9">
                            <div class="col col-sm-4">
                                <label for="photo1">Photo 1</label>
                                <input type="hidden" name="photo1">
                                <img class="mt-3 photo1Preview">
                                <input type="file" class="form-control" accept=".png, .jpg, .jpeg" id="photo1" 
                                name="photo1" onchange="previewImg1()" required>
                            </div>
                            <div class="col col-sm-4">
                                <label for="photo2">Photo 2</label>
                                <input type="hidden" name="photo2">
                                <img class="mt-3 photo2Preview">
                                <input type="file" class="form-control" accept=".png, .jpg, .jpeg" id="photo2" 
                                name="photo2" onchange="previewImg2()" required>
                            </div>
                            <div class="col col-sm-4">
                                <label for="photo3">Photo 3</label>
                                <input type="hidden" name="photo3">
                                <img class="mt-3 photo3Preview">
                                <input type="file" class="form-control" accept=".png, .jpg, .jpeg" id="photo3" 
                                name="photo3" onchange="previewImg3()" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="package_desc" class="col-sm-3 col-form-label">Package Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="packageDesc" id="package_desc" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="mb-4 row justify-content-end">
                        <label for="" class="col-sm-3 col-form-label">Itinerary</label>
                        <div class="row col-sm-9 mb-2 itin1" id="itin1">
                            <div class="col-sm-3 mb-2">
                                <label for="location1">Location</label>
                                <input type="text" class="form-control" id="location1" name="location1" placeholder="Location" required>
                            </div>
                            <div class="col-sm-9 mb-2">
                                <label for="description1">Description</label>
                                <input type="text" class="form-control" id="description1" name="description1" placeholder="Description" required>
                            </div>
                            <div class="col-sm-2 btnAdd1" id="btn-add1">
                                <button type="button" class="btn btn-primary" onclick="text1(0)">Add</button>
                            </div>                            
                        </div>
                        <div class="row col-sm-9 mb-2 itin2" id="itin2" style="display: none">
                            <div class="col-sm-3 mb-2">
                                <input type="text" class="form-control" id="location2" name="location2" placeholder="Location">
                            </div>
                            <div class="col-sm-9 mb-2">
                                <input type="text" class="form-control" id="description2" name="description2" placeholder="Description">
                            </div>
                            <div class="col-sm-2 btnAdd2" id="btn-add2">
                                <button type="button" class="btn btn-primary" onclick="text2(0)">Add</button>
                            </div>                            
                            <div class="col-sm-2 btnRemove2" id="btn-remove2">
                                <button type="button" class="btn btn-danger" onclick="text1(1)">Remove</button>
                            </div>                            
                        </div>
                        <div class="row col-sm-9 mb-2 itin3" id="itin3" style="display: none">
                            <div class="col-sm-3 mb-2">
                                <input type="text" class="form-control" id="location3" name="location3" placeholder="Location">
                            </div>
                            <div class="col-sm-9 mb-2">
                                <input type="text" class="form-control" id="description3" name="description3" placeholder="Description">
                            </div>
                            <div class="col-sm-2 btnAdd3" id="btn-add3">
                                <button type="button" class="btn btn-primary" onclick="text3(0)">Add</button>
                            </div>                            
                            <div class="col-sm-2 btnRemove3" id="btn-remove3">
                                <button type="button" class="btn btn-danger" onclick="text2(1)">Remove</button>
                            </div>                            
                        </div>
                        <div class="row col-sm-9 mb-2 itin4" id="itin4" style="display: none">
                            <div class="col-sm-3 mb-2">
                                <input type="text" class="form-control" id="location4" name="location4" placeholder="Location">
                            </div>
                            <div class="col-sm-9 mb-2">
                                <input type="text" class="form-control" id="description4" name="description4" placeholder="Description">
                            </div>
                            <div class="col-sm-2 btnAdd4" id="btn-add4">
                                <button type="button" class="btn btn-primary" onclick="text4(0)">Add</button>
                            </div>                            
                            <div class="col-sm-2 btnRemove4" id="btn-remove4">
                                <button type="button" class="btn btn-danger" onclick="text3(1)">Remove</button>
                            </div>                            
                        </div>
                        <div class="row col-sm-9 mb-2 itin5" id="itin5" style="display: none">
                            <div class="col-sm-3 mb-2">
                                <input type="text" class="form-control" id="location5" name="location5" placeholder="Location">
                            </div>
                            <div class="col-sm-9 mb-2">
                                <input type="text" class="form-control" id="description5" name="description5" placeholder="Description">
                            </div>
                            <div class="col-sm-2 btnAdd5" id="btn-add5">
                                <button type="button" class="btn btn-primary"  onclick="text5(0)">Add</button>
                            </div>                            
                            <div class="col-sm-2 btnRemove5" id="btn-remove5">
                                <button type="button" class="btn btn-danger" onclick="text4(1)">Remove</button>
                            </div>                            
                        </div>
                        <div class="row col-sm-9 mb-2 itin6" id="itin6" style="display: none">
                            <div class="col-sm-3 mb-2">
                                <input type="text" class="form-control" id="location6" name="location6" placeholder="Location">
                            </div>
                            <div class="col-sm-9 mb-2">
                                <input type="text" class="form-control" id="description6" name="description6" placeholder="Description">
                            </div>
                            <div class="col-sm-2 btnAdd6" id="btn-add6">
                                <button type="button" class="btn btn-primary" onclick="text6(0)">Add</button>
                            </div>                            
                            <div class="col-sm-2 btnRemove6" id="btn-remove6">
                                <button type="button" class="btn btn-danger" onclick="text5(1)">Remove</button>
                            </div>                            
                        </div>
                        <div class="row col-sm-9 mb-2 itin7" id="itin7" style="display: none">
                            <div class="col-sm-3 mb-2">
                                <input type="text" class="form-control" id="location7" name="location7" placeholder="Location">
                            </div>
                            <div class="col-sm-9 mb-2">
                                <input type="text" class="form-control" id="description7" name="description7" placeholder="Description">
                            </div>
                            <div class="col-sm-2 btnAdd7" id="btn-add7">
                                <button type="button" class="btn btn-primary" onclick="text7(0)">Add</button>
                            </div>                            
                            <div class="col-sm-2 btnRemove7" id="btn-remove7">
                                <button type="button" class="btn btn-danger" onclick="text6(1)">Remove</button>
                            </div>                            
                        </div>
                        <div class="row col-sm-9 mb-2 itin8" id="itin8" style="display: none">
                            <div class="col-sm-3 mb-2">
                                <input type="text" class="form-control" id="location8" name="location8" placeholder="Location">
                            </div>
                            <div class="col-sm-9 mb-2">
                                <input type="text" class="form-control" id="description8" name="description8" placeholder="Description">
                            </div>
                            <div class="col-sm-2 btnAdd8" id="btn-add8">
                                <button type="button" class="btn btn-primary" onclick="text8(0)">Add</button>
                            </div>                            
                            <div class="col-sm-2 btnRemove8" id="btn-remove8">
                                <button type="button" class="btn btn-danger" onclick="text7(1)">Remove</button>
                            </div>                            
                        </div>
                        <div class="row col-sm-9 mb-2 itin9" id="itin9" style="display: none">
                            <div class="col-sm-3 mb-2">
                                <input type="text" class="form-control" id="location9" name="location9" placeholder="Location">
                            </div>
                            <div class="col-sm-9 mb-2">
                                <input type="text" class="form-control" id="description9" name="description9" placeholder="Description">
                            </div>
                            <div class="col-sm-2 btnAdd9" id="btn-add9">
                                <button type="button" class="btn btn-primary" onclick="text9(0)">Add</button>
                            </div>                            
                            <div class="col-sm-2 btnRemove9" id="btn-remove9">
                                <button type="button" class="btn btn-danger" onclick="text8(1)">Remove</button>
                            </div>                            
                        </div>
                        <div class="row col-sm-9 mb-2 itin10" id="itin10" style="display: none">
                            <div class="col-sm-3 mb-2">
                                <input type="text" class="form-control" id="location10" name="location10" placeholder="Location">
                            </div>
                            <div class="col-sm-9 mb-2">
                                <input type="text" class="form-control" id="description10" name="description10" placeholder="Description">
                            </div>
                            <div class="col-sm-2 btnRemove10" id="btn-remove10">
                                <button type="button" class="btn btn-danger" onclick="text9(1)">Remove</button>
                            </div>                            
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="inclusion" class="col-sm-3 col-form-label">Inclusion</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="inclusion" id="inclusion" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="exclusion" class="col-sm-3 col-form-label">Exclusion</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="exclusion" id="exclusion" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="note" class="col-sm-3 col-form-label">Note</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="note" id="note" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function text1(x){
        if (x == 0) document.getElementById("itin2").style.display = "flex",
                    document.getElementById("btn-add1").style.display = "none";
        else document.getElementById("itin2").style.display = "none",
             document.getElementById("btn-add1").style.display = "flex";
        return;
    }
    function text2(x){
        if (x == 0) document.getElementById("itin3").style.display = "flex",
                    document.getElementById("btn-add2").style.display = "none",
                    document.getElementById("btn-remove2").style.display = "none";
        else document.getElementById("itin3").style.display = "none",
             document.getElementById("btn-add2").style.display = "flex",
             document.getElementById("btn-remove2").style.display = "flex";
        return;
    }
    function text3(x){
        if (x == 0) document.getElementById("itin4").style.display = "flex",
                    document.getElementById("btn-add3").style.display = "none",
                    document.getElementById("btn-remove3").style.display = "none";
        else document.getElementById("itin4").style.display = "none",
             document.getElementById("btn-add3").style.display = "flex",
             document.getElementById("btn-remove3").style.display = "flex";
        return;
    }
    function text4(x){
        if (x == 0) document.getElementById("itin5").style.display = "flex",
                    document.getElementById("btn-add4").style.display = "none",
                    document.getElementById("btn-remove4").style.display = "none";
        else document.getElementById("itin5").style.display = "none",
             document.getElementById("btn-add4").style.display = "flex",
             document.getElementById("btn-remove4").style.display = "flex";
        return;
    }
    function text5(x){
        if (x == 0) document.getElementById("itin6").style.display = "flex",
                    document.getElementById("btn-add5").style.display = "none",
                    document.getElementById("btn-remove5").style.display = "none";
        else document.getElementById("itin6").style.display = "none",
             document.getElementById("btn-add5").style.display = "flex",
             document.getElementById("btn-remove5").style.display = "flex";
        return;
    }
    function text6(x){
        if (x == 0) document.getElementById("itin7").style.display = "flex",
                    document.getElementById("btn-add6").style.display = "none",
                    document.getElementById("btn-remove6").style.display = "none";
        else document.getElementById("itin7").style.display = "none",
             document.getElementById("btn-add6").style.display = "flex",
             document.getElementById("btn-remove6").style.display = "flex";
        return;
    }
    function text7(x){
        if (x == 0) document.getElementById("itin8").style.display = "flex",
                    document.getElementById("btn-add7").style.display = "none",
                    document.getElementById("btn-remove7").style.display = "none";
        else document.getElementById("itin8").style.display = "none",
             document.getElementById("btn-add7").style.display = "flex",
             document.getElementById("btn-remove7").style.display = "flex";
        return;
    }
    function text8(x){
        if (x == 0) document.getElementById("itin9").style.display = "flex",
                    document.getElementById("btn-add8").style.display = "none",
                    document.getElementById("btn-remove8").style.display = "none";
        else document.getElementById("itin9").style.display = "none",
             document.getElementById("btn-add8").style.display = "flex",
             document.getElementById("btn-remove8").style.display = "flex";
        return;
    }
    function text9(x){
        if (x == 0) document.getElementById("itin10").style.display = "flex",
                    document.getElementById("btn-add9").style.display = "none",
                    document.getElementById("btn-remove9").style.display = "none";
        else document.getElementById("itin10").style.display = "none",
             document.getElementById("btn-add9").style.display = "flex",
             document.getElementById("btn-remove9").style.display = "flex";
        return;
    }

    function previewImg1() {
        const photo = document.querySelector('#photo1');
        const preview = document.querySelector('.photo1Preview');

        preview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(photo.files[0]);

        oFReader.onload = function(oFREven){
            preview.src = oFREven.target.result;
        }
    }
    function previewImg2() {
        const photo = document.querySelector('#photo2');
        const preview = document.querySelector('.photo2Preview');

        preview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(photo.files[0]);

        oFReader.onload = function(oFREven){
            preview.src = oFREven.target.result;
        }
    }
    function previewImg3() {
        const photo = document.querySelector('#photo3');
        const preview = document.querySelector('.photo3Preview');

        preview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(photo.files[0]);

        oFReader.onload = function(oFREven){
            preview.src = oFREven.target.result;
        }
    }
    // =============CKEditor for the text area========
    ClassicEditor
		.create( document.querySelector( '#package_desc' ) )
		.catch( error => {
			console.error( error );
		} );
    ClassicEditor
		.create( document.querySelector( '#inclusion' ) )
		.catch( error => {
			console.error( error );
		} );
    ClassicEditor
		.create( document.querySelector( '#exclusion' ) )
		.catch( error => {
			console.error( error );
		} );
    ClassicEditor
		.create( document.querySelector( '#note' ) )
		.catch( error => {
			console.error( error );
		} );
</script>