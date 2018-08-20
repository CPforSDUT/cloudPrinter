#include<stdio.h>
#include<stdlib.h>

#define CAN  1
#define CANT 0

#define IS   1
#define NOT  0

#define noWhere -1

#define TRUE  1
#define FALSE 0
int back[8][8];
int thisc[8];
int n,k;
int ans;
void init(void)
{
    for (int i = 0 ; i < 8 ; i ++)
    {
        for(int j = 0 ; j < 8 ; j ++)
        {
            back[i][j] = CANT;
        }
        thisc[i] = noWhere;
    }
    ans = 0;
}
int isOk(void)
{
    int cont = 0;
    for (int i = 0 ; i < n ; i ++)
    {
        if(thisc[i] != noWhere){
            cont += 1;
        }
    }
    if(cont != k){
        return FALSE;
    }
    for (int i = 0 ; i < n ;i ++)
    {
        if(thisc[i] == noWhere){
            continue;
        }
        for(int j = 0 ; j < n ; j ++)
        {
            if(i == j){
                continue;
            }
            if(thisc[i] == thisc[j]){
                return FALSE;
            }
        }
    }
    return TRUE;
}
void comput(int this)
{
    if(this >= n){
        if(isOk()){
            ans += 1;
        }
        return ;
    }
    for (int i = noWhere ; i < n ; i ++)
    {
        if(i == noWhere || back[this][i] == CAN ){
            thisc[this] = i;
            comput(this + 1);
        }
    }
}
int main ()
{

    while(scanf("%d%d",&n,&k))
    {
        init();
        if(n == -1 && k == -1){
            return 0;
        }
        for(int i = 0 ; i < n ; i ++)
        {
            char input[9];
            scanf("%s",input);
            for (int j = 0 ; j < n ; j ++){
                back[i][j] = input[j] == '#' ? CAN : CANT;
            }
        }
        comput(0);
        printf("%d\n",ans);
    }
}
