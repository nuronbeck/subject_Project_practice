using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace lab3
{
    [Table("client")]
    public class Client
    {
        [Column("id_client")]
        public int ClientId { get; set; }
        public string fio_client { get; set; }
        public string phone_client { get; set; }
    }
}
