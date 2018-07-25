Hello {{ $item->receiver }},
This is a demo email for testing purposes! Also, it's the HTML version.
 
Demo object values:
 
Demo One: {{ $item->demo_one }}
Demo Two: {{ $item->demo_two }}
 
Values passed by With method:
 
testVarOne: {{ $testVarOne }}
testVarOne: {{ $testVarOne }}
 
Thank You,
{{ $item->sender }}