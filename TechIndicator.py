from alpha_vantage.techindicators import TechIndicators
import matplotlib.pyplot as plt

stockName = "SHLD"

ti = TechIndicators(key='08JEXNB0BE9U4IWE', output_format='pandas')
data, meta_data = ti.get_bbands(symbol=stockName, interval='60min', time_period=60)
data.plot()
plt.title('BBbands indicator for ' + stockName + ' stock (60 min)')
plt.show()
