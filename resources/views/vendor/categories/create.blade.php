@extends('vendor.layouts.master')
@section('content')


    <div class="container-fluid ">
        <div class="card">
            <div class="card-header ">
                <h2>Add New Category</h2>
            </div>
            <div class="card-body">
                <div class=" col-md-6 mx-auto">
                    <form>
                        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto p-20">

                            {{-- title --}}
                            <div class="row mb-3 ">
                                <label for="title" class="col-sm-3 col-form-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Please Enter Category title...">
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="row mb-3">
                                <label for="description" class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="description" id="description" rows="5" cols="30"
                                        placeholder="Please write Description about Category..." required></textarea>
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="row mb-3">
                                <label for="image" class="col-sm-3 col-form-label">Image</label>
                                <input name="image" id="image" type="file">
                            </div>

                            {{-- Status --}}
                            <div class="row mb-3">
                                <label for="status" class="col-sm-3 col-form-label">Status</label>
                                <label class="toggle-switch">
                                    <input name="status" type="checkbox">
                                    <span class="toggle-switch-slider rounded-circle"></span>
                                </label>

                            </div>

                            {{-- Featured --}}
                            <div class="row mb-3">
                                <label for="featured" class="col-sm-3 col-form-label">Featured</label>
                                <label class="toggle-switch">
                                    <input name="featured" type="checkbox">
                                    <span class="toggle-switch-slider rounded-circle"></span>
                                </label>

                            </div>

                        </div>


                        <button type="submit" class="btn btn-primary">Sign in</button>
                </div>

            </div>
        </div>




        </form>

    </div>
    </div>
    </div>

@endsection
