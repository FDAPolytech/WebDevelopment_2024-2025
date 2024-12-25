using System.Reflection.Metadata;

namespace WebLab3Task2.Data;

public class DataService : IDataService
{
    private readonly Dictionary<string, string> _dataStore = new();

    public void AddData(string key, string value)
    {
        _dataStore[key] = value;
    }

    public Dictionary<string, string> GetData()
    {
        return _dataStore;
    }
}