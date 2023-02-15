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
</style>
</head>
<body>

<h1>Tracking details</h1>

<table id="customers">
  <tr>
    <th>{{ __('track.Tracking Number') }}</th>
    <th>{{ __('track.Code Number') }}</th>
    <th>{{ __('track.Tracking Status') }}</th>
    <th>{{ __('track.type tracking') }}</th>
    <th>{{ __('track.country') }}</th>
  </tr>
  <tr>
  <td>{{$details['tracking_number']}}</td>
  <td>{{$details['code_number']}}</td>
  <td>{{$details['status']['Status_Name']}}</td>
  <td>{{$details['tracktype']['tracking_type_name']}}</td>
  <td>{{$details['Country']['Country_Name']}}</td>
  </tr>









</table>
<br>
<br>
 <i> Date : {{date('d.m.Y') }}</i>

</body>
</html>
