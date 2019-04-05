using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;

namespace lab3
{
    [ServiceContract]
    public interface IService1
    {
        [OperationContract]
        IEnumerable<Client> GetClients();
        [OperationContract]
        Client GetClient(int id);
        [OperationContract]
        int AddClient(Client client);
        [OperationContract]
        Client EditClient(Client client);
        [OperationContract]
        int DeleteClient(Client client);

        [OperationContract]
        IEnumerable<Service> GetServices();
        [OperationContract]
        Service GetService(int id);
        [OperationContract]
        int AddService(Service service);
        [OperationContract]
        Service EditService(Service service);
        [OperationContract]
        int DeleteService(Service service);

        [OperationContract]
        IEnumerable<Request> GetRequests();
        [OperationContract]
        Request GetRequest(int id);
        [OperationContract]
        int AddRequest(Request request);
        [OperationContract]
        Request EditRequest(Request request);
        [OperationContract]
        int DeleteRequest(Request request);

    }
}
