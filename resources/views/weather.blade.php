<div class="container mt-5 center">
    <form action="{{ route('search.weather') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Search city:</strong>
                    <input type="text" name="city" class="form-control" placeholder="Search city">
                </div>
                @error('city')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <!-- <strong>Search city:</strong> -->
                    <input type="submit" name="submit" class="form-control">
                </div>
            </div>
        </div>
    </form>

    <div class="sdw">
        <<a href="{{ route('live.scores') }}">Live score</a>
</div>