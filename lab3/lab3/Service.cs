using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace lab3
{
    [Table("service")]
    public class Service
    {
        [Column("id_service")]
        public int ServiceId { get; set; }
        public string name_service { get; set; }
    }
}