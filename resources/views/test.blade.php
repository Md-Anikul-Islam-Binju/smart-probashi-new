<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('test.request')}}" method="post">@csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Education Level</label>
                                <select name="education[0][level]" id="" class="form-control">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Passing Year</label>
                                <select name="education[0][passing_year]" id="" class="form-control">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Institute</label>
                                <input type="text" name="education[0][institute]" id="" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Board</label>
                                <select name="education[0][board]" id="" class="form-control">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Subject</label>
                                <input type="text" name="education[0][subject]" id="" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Grade</label>
                                <input type="text" name="education[0][grade]" id="" class="form-control">
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
