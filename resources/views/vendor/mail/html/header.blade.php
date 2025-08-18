@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://bolt-tube.b-cdn.net/logo1.JPG" class="logo" alt="Bottube">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
