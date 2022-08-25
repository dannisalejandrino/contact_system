<table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">NAME</th>
        <th scope="col">COMPANY</th>
        <th scope="col">PHONE</th>
        <th scope="col">EMAIL</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $key=>$contact)
        <tr>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->company }}</td>
            <td>{{ $contact->phone }}</td>
            <td>{{ $contact->email }}</td>
            <td>
                <a href=""
                    class="btn btn-success update_product_form"
                    data-bs-toggle="modal"
                    data-bs-target="#updateModal"
                    data-id="{{ $contact->id }}"
                    data-name="{{ $contact->name }}"
                    data-company ="{{ $contact->company }}"
                    data-phone ="{{ $contact->phone }}"
                    data-email ="{{ $contact->email }}">
                    <i class="las la-edit"></i>
                </a>
                <a href=""
                    class="btn btn-danger delete_contact_form"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteModal"
                    data-id="{{ $contact->id }}">
                    <i class="las la-times"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $contacts->render() !!}
