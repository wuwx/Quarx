@extends('quarx::layouts.dashboard')

@section('content')

    <div class="modal fade" id="deleteModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="deleteModalLabel">Delete Pages</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this page?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a id="deleteBtn" type="button" class="btn btn-warning" href="#">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <a class="btn btn-primary pull-right" href="{!! route('quarx.pages.create') !!}">Add New</a>
        <div class="raw-m-hide pull-right">
            {!! Form::open(['url' => 'quarx/pages/search']) !!}
            <input class="form-control header-input pull-right raw-margin-right-24" name="term" placeholder="Search">
            {!! Form::close() !!}
        </div>
        <h1 class="page-header">Pages</h1>
    </div>

    <div class="row">
        @if (isset($term))
            <div class="well text-center">Searched for "{!! $term !!}".</div>
        @endif

        @if($pages->count() === 0)
            <div class="well text-center">No pages found.</div>
        @else
            <table class="table table-striped">
                <thead>
                    <th>Title</th>
                    <th class="raw-m-hide">Url</th>
                    <th class="raw-m-hide text-center">Is Published</th>
                    <th width="200px" class="text-right">Actions</th>
                </thead>
                <tbody>

                @foreach($pages as $page)
                    <tr>
                        <td><a href="{!! route('quarx.pages.edit', [$page->id]) !!}">{!! $page->title !!}</a></td>
                        <td class="raw-m-hide">{!! $page->url !!}</td>
                        <td class="raw-m-hide text-center">
                            @if ($page->is_published)
                                <span class="fa fa-check"></span>
                            @else
                                <span class="fa fa-close"></span>
                            @endif
                        </td>
                        <td class="text-right">
                            <form method="post" action="{!! url('quarx/pages/'.$page->id) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button class="delete-btn btn btn-xs btn-danger pull-right" type="submit"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                            <a class="btn btn-xs btn-default pull-right raw-margin-right-8" href="{!! route('quarx.pages.edit', [$page->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="text-center">
        {!! $pagination !!}
    </div>
</div>

@endsection

