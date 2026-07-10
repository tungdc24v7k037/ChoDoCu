<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Laravel Test</title>
</head>
<body>

<h1>Danh mục</h1>

@if($categories->count())

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Slug</th>
        </tr>

        @foreach($categories as $category)

            <div>
        <a href="{{ route('categories.show', $category->slug) }}">
            {{ $category->name }}
        </a>
    </div>

        @endforeach

    </table>

@else

    <h3>Chưa có dữ liệu</h3>

@endif

</body>
</html>