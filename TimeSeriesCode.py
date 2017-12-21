from alpha_vantage.timeseries import TimeSeries
import matplotlib.pyplot as plt

#stockName = "GOOGL"
stockName = "SHLD"

ts = TimeSeries(key='08JEXNB0BE9U4IWE', output_format='pandas')
data, meta_data = ts.get_intraday(symbol= stockName,interval='1min', outputsize='full')
data['close'].plot()
plt.title('Intraday Times Series for the ' + stockName +' stock (1 min)')
plt.show()
