@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Wholesale Inquiries</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Company</th>
                <th>Contact Person</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inquiries as $inquiry)
                <tr>
                    <td>{{ $inquiry->id }}</td>
                    <td>{{ $inquiry->company_name }}</td>
                    <td>{{ $inquiry->contact_person }}</td>
                    <td>{{ $inquiry->email }}</td>
                    <td>{{ $inquiry->phone }}</td>
                    <td>{{ Str::limit($inquiry->message, 30) }}</td>
                    <td>{{ ucfirst($inquiry->status) }}</td>
                    <td>
                        <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" class="btn btn-info btn-sm">View</a>
                        <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this inquiry?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">No inquiries found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
