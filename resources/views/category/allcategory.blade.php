@extends('layouts.layout')
@section('siteTitle')
All Category
@endsection

@section('content')
<ul class="buttons d_flex">
    <li><a href="{{ URL::to('category') }}"><button class="flat-btn">all category</button></a></li>
    <li><a href="{{ URL::to('category/create') }}"><button class="flat-btn">add category</button></a></li>
    <li><a href="{{ URL::to('post') }}"><button class="flat-btn">all posts</button></a></li>
    <li><a href="{{ URL::to('post/create') }}"><button class="flat-btn">write post</button></a></li>
</ul>
<hr>

<table class="table">
    <thead>
        <th>SL</th>
        <th>Category Name</th>
        <th>Slug</th>
        <th>Created at</th>
        <th>Action</th>
    </thead>
    <tbody>
        @php
        $count = 1;
        @endphp
        @foreach ($categories as $row)
        <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->slug }}</td>
            <td>{{ $row->created_at->format('dS F, Y') }}</td>
            <td>
                <a href="{{ url('category/'. $row->id.'/edit') }}" class="btn">Edit</a>
                <a href="{{ url('category/'. $row->id) }}" class="btn">View</a>

                <form action="" id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" id="delete"
                        data-action="{{ url('category/'. $row->id) }}">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection