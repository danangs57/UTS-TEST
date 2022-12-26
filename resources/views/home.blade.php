@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} <small>( {{auth()->user()->role}} )</small></div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if(auth()->user()->role == 'User')
                    @include('user_home')


                    @else
                    @include('super_user_home')

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        // console.log($('.reimbursement_table'));
        // var table = $('.reimbursement_table').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: "{{ route('reimbursement.datatable') }}",
        //     columns: [{
        //             data: 'id',
        //             name: 'id'
        //         },
        //         {
        //             data: 'action',
        //             name: 'action',
        //             orderable: false,
        //             searchable: false
        //         },
        //     ]
        // });

        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();

            var controlForm = $('.controls:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);

            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="fa fa-trash">-</span>');
        }).on('click', '.btn-remove', function(e) {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });
</script>
@endsection