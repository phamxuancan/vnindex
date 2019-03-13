@if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach( $errors->all() as $err)
                    <li>{{ $err }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></li>
                @endforeach
            </ul>
        </div>
    @endif