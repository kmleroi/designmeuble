
<div class="row">
    <div class="col-12">
        @if((isset($errors) && count($errors)) || \App\Classes\Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>
                    @if(\App\Classes\Session::has('error'))
                        {{ \App\Classes\Session::flash('error') }}
                    @else
                        @foreach($errors as $error)
                            {{ $error }} <br />
                        @endforeach
                    @endif
                </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(isset($success) || \App\Classes\Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>
                    @if(isset($success))
                            {{ $success }}
                    @elseif(\App\Classes\Session::has('success'))
                        {{ \App\Classes\Session::flash('success') }}
                    @endif
                </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

</div>