from alpha_vantage.timeseries import TimeSeries
ts = TimeSeries(key='08JEXNB0BE9U4IWE')
# Get json object with the intraday data and another with  the call's metadata
data, meta_data = ts.get_intraday('GOOGL')

ts = TimeSeries(key='08JEXNB0BE9U4IWE',retries='YOUR_RETRIES')
ts = TimeSeries(key='08JEXNB0BE9U4IWE',output_format='pandas')

print(data)
