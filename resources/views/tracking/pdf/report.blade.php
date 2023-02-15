<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}


@page {
  header: page-header;
  footer: page-footer;
}
</style>
</head>
<body>
<htmlpageheader name="page-header">
  Your Header Content
</htmlpageheader>

<h1>Tracking details</h1>

<table id="customers">
  <tr>
    <th>{{ __('track.Tracking Number') }}</th>
    <th>{{ __('track.Code Number') }}</th>
    <th>{{ __('track.Tracking Status') }}</th>
    <th>{{ __('track.type tracking') }}</th>
    <th>{{ __('track.country') }}</th>
  </tr>

  <?php $i = 0; ?>
                        @foreach($details as  $detail)
  <tr>

                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{$detail['tracking_number']}}</td>
                                <td>{{$detail->code_number}}</td>



                                </tr>





                                @endforeach




</table>
<br>
<br>
 <i> Date : {{date('d.m.Y') }}</i>



 <htmlpagefooter name="page-footer">
  Your Footer Content
</htmlpagefooter>
</body>
</html>
