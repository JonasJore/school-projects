using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(Trafikkskole.Startup))]
namespace Trafikkskole
{
    public partial class Startup {
        public void Configuration(IAppBuilder app) {
            ConfigureAuth(app);
        }
    }
}
