<x-layouts.main>

    <x-layouts.header>
        Post edit {{$post->id}}
    </x-layouts.header>

    <div class="col-lg-7 mb-5 mb-lg-0">
        <div class="contact-form">
            <div id="success"></div>
            <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                <div class="control-group mb-4">
                    <input type="text" class="form-control p-4" name="title" value="{{ $post->title }}" placeholder="Title"/>
                    <p class="help-block text-danger"></p>
                    @error('title')
                        <p class="help-block text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="control-group mb-4">
                    <textarea type="text" class="form-control p-4" name="short_content" placeholder="Short content">{{ $post->short_content }}</textarea>
                    @error('short_content')
                        <p class="help-block text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="control-group mb-4">
                    <textarea class="form-control p-4" rows="6" name="content" placeholder="Text">{{ $post->content }}</textarea>
                    @error('content')
                        <p class="help-block text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="control-group mb-4">
                    <input name="photo" type="file" class="form-control p-4" id="subject" placeholder="Photo"/>
                    @error('photo')
                        <p class="help-block text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex">
                    <button class="btn btn-success py-3 px-5" type="submit" id="sendMessageButton">SAVE</button>
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-danger py-3 px-5">Back</a>

                </div>
            </form>
        </div>
    </div>


</x-layouts.main>