using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace lab3
{
    [Table("request")]
    public class Request
    {
        [Column("id_request")]
        public int RequestId { get; set; }

        [Column("client_id")]
        public int ClientId { get; set; }

    }
}