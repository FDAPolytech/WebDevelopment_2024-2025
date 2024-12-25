namespace WebLab3Task2.Data;

public interface IDataService
{
    void AddData(string key, string value);
    Dictionary<string, string> GetData();
}