using System.ComponentModel.DataAnnotations;

namespace WebLab3Task2.Models
{
    public class UserProfile
    {
        [Required(ErrorMessage = "Пожалуйста, укажите фамилию.")]
        [StringLength(50, ErrorMessage = "Фамилия должна быть менее 50 символов.")]
        public string LastName { get; set; }

        [Required(ErrorMessage = "Пожалуйста, укажите имя.")]
        [StringLength(50, ErrorMessage = "Имя должно быть менее 50 символов.")]
        public string FirstName { get; set; }

        [Required(ErrorMessage = "Пожалуйста, укажите электронную почту.")]
        [EmailAddress(ErrorMessage = "Некорректный формат электронной почты.")]
        public string Email { get; set; }

        [Required(ErrorMessage = "Пожалуйста, выберите животное.")]
        public string Animal { get; set; }

        [MinLength(1, ErrorMessage = "Пожалуйста, выберите хотя бы одно транспортное средство.")]
        public List<string> Transport { get; set; } = new List<string>();
    }
}
