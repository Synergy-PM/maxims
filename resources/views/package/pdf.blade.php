<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $package->name }}</title>
</head>

<body>
    @include('package.partials.brochure', ['package' => $package, 'forPdf' => true])
</body>

</html>
