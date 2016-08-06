# Pebble Health Export logger in PHP

This is a simple PHP script to accept data from
[pebble-health-export](https://github.com/faelys/pebble-health-export) by 
[@faelys](https://github.com/faelys).

## Configuration

The script supports both single and bundled upload and can be configured by editing
the options at the top of the script.

* $datafile
  This is the output file. Ensure your server has write permission here.
* $single_key / $bundle_key
  This is the value you entered in the `Data Field Name` in the Pebble app.
* $delimiter
  This is the value you entered in the `Line Separator` field in the Pebble app.

## Sample Response

```js
{
  "startTime": "2016-08-06T16:20:56Z",
  "outputFile": "/tmp/pebble.txt",
  "create": false,
  "bundled": true,
  "records": 2,
  "bytes": 16,
  "endTime": "2016-08-06T16:20:56Z",
  "message": "Processed 2 records in 1.414ms."
}
```

## Sample output file

```
Time,Steps,yaw,pitch,VMC,ambient light,activity level
2016-08-06T16:43:00Z,0,13,8,0,1,0

```