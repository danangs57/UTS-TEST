<section>
    <table class="table table-bordered reimbursement_table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Date</th>
                <th>Description</th>
                <th>Status</th>
                <th>Image</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</section>

<script>
    $(document).ready(function() {
        $.noConflict();
        var table = $('.reimbursement_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('reimbursement.datatable') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        if (data == 0) {
                            return 'In Review';
                        } else if (data == 1) {
                            return 'Approved';

                        } else {
                            return 'Rejected';

                        }
                    },
                },
                {
                    data: 'images',
                    name: 'images',
                    className: "image",
                    render: function(d, t, r) {
                        console.log(d[0].path);
                        return d ?
                            "<img src=\"/images/ReimbursementImage/" + d[0].path + "\" height=\"150\" width=\"150\"\
                        alt = 'No Image' /> " :
                            null

                    },
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                },
            ]
        });

        table.on("click", "td.image", function(e) {
            e.preventDefault()

            let table = $(this).closest("table").DataTable()
            let row = $(this).closest("tr")
            let data = table.row(row).data()
            console.log(data.images[0].path);
            console.log(data);

            let image = new Image()
            image.src = "{{asset('images/ReimbursementImage')}}" + "/" + data.images[0].path
            image.alt = data.images[0].path

            let viewer = new Viewer(image, {
                zoomRatio: 2,
                maxZoomRatio: 2,
                hidden: function() {
                    viewer.destroy();
                }
            }).show()
        })
    });

    function approval(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}",
            },
            type: "POST",
            url: "{{route('reimbursement.approval')}}",
            data: {
                "id": id,
            },
            success: function(tekst) {
                $('.reimbursement_table').DataTable().ajax.reload();
            },
            error: function(request, error) {
                console.log("ERROR:" + error);
                alert(error)

            }
        });
    }

    function rejection(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}",
            },
            type: "POST",
            url: "{{route('reimbursement.rejection')}}",
            data: {
                "id": id,
            },
            success: function(tekst) {
                $('.reimbursement_table').DataTable().ajax.reload();
            },
            error: function(request, error) {
                console.log("ERROR:" + error);
                alert(error)

            }
        });
    }
</script>