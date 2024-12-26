using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace WebLab4Task1
{
    public class User
    {
        [Column("surname")]
        public string? Surname { get; set; }
        [Column("name")]
        public string? Name { get; set; }

        [Column("address")]
        public string? Address { get; set; }
        [Key]
        [Column("email")]
        public string Email { get; set; }

        [Column("product")]
        public string? Product { get; set; }
        [Column("comment")]
        public string? Comment { get; set; }
    }
}
